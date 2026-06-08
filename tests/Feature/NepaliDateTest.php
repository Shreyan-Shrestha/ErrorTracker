<?php

declare(strict_types=1);

namespace Tests\Unit\Helpers\NepaliDate;

use App\Helpers\NepaliDate\src\NepaliDate;
use App\Helpers\NepaliDate\src\NepaliDateImmutable;
use App\Helpers\NepaliDate\src\Exceptions\NepaliDateFormatException;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class NepaliDateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        NepaliDate::setDefaultTimeZoneName('Asia/Kathmandu');
        NepaliDate::resetDefaultParserFormats();
    }

    // -----------------------------------------------------------------------
    // now()
    // -----------------------------------------------------------------------

    public function test_now_returns_nepali_date_instance(): void
    {
        $date = NepaliDate::now();

        $this->assertInstanceOf(NepaliDate::class, $date);
    }

    public function test_now_returns_valid_nepali_year(): void
    {
        $date = NepaliDate::now();

        // Nepali year should be roughly AD year + 56/57
        $this->assertGreaterThanOrEqual(2080, $date->getYear());
        $this->assertLessThanOrEqual(2090, $date->getYear());
    }

    public function test_now_returns_valid_month(): void
    {
        $date = NepaliDate::now();

        $this->assertGreaterThanOrEqual(1, $date->getMonth());
        $this->assertLessThanOrEqual(12, $date->getMonth());
    }

    public function test_now_returns_valid_day(): void
    {
        $date = NepaliDate::now();

        $this->assertGreaterThanOrEqual(1, $date->getDay());
        $this->assertLessThanOrEqual(32, $date->getDay());
    }

    public function test_now_uses_given_timezone(): void
    {
        $date = NepaliDate::now('UTC');

        $this->assertSame('UTC', $date->getTimezone()->getName());
    }

    // -----------------------------------------------------------------------
    // Constructor & basic getters
    // -----------------------------------------------------------------------

    public function test_constructor_sets_year_month_day(): void
    {
        $date = new NepaliDate(2081, 3, 15);

        $this->assertSame(2081, $date->getYear());
        $this->assertSame(3,    $date->getMonth());
        $this->assertSame(15,   $date->getDay());
    }

    public function test_constructor_sets_time(): void
    {
        $date = new NepaliDate(2081, 3, 15, 10, 30, 45);

        $this->assertSame(10, $date->getHour());
        $this->assertSame(30, $date->getMinute());
        $this->assertSame(45, $date->getSecond());
    }

    public function test_constructor_defaults_time_to_midnight(): void
    {
        $date = new NepaliDate(2081, 3, 15);

        $this->assertSame(0, $date->getHour());
        $this->assertSame(0, $date->getMinute());
        $this->assertSame(0, $date->getSecond());
    }

    public function test_get_two_digit_month(): void
    {
        $date = new NepaliDate(2081, 3, 15);

        $this->assertSame('03', $date->getTwoDigitMonth());
    }

    public function test_get_two_digit_day(): void
    {
        $date = new NepaliDate(2081, 3, 5);

        $this->assertSame('05', $date->getTwoDigitDay());
    }

    public function test_get_maridian_am(): void
    {
        $date = new NepaliDate(2081, 3, 15, 9, 0, 0);

        $this->assertSame('AM', $date->getMaridian());
    }

    public function test_get_maridian_pm(): void
    {
        $date = new NepaliDate(2081, 3, 15, 14, 0, 0);

        $this->assertSame('PM', $date->getMaridian());
    }

    // -----------------------------------------------------------------------
    // fromAd()
    // -----------------------------------------------------------------------

    public function test_from_ad_converts_correctly(): void
    {
        $ad = new \DateTime('2024-09-10'); // Known AD date → 2081 Bhadra 25
        $bs = NepaliDate::fromAd($ad);

        $this->assertSame(2081, $bs->getYear());
        $this->assertSame(5,    $bs->getMonth()); // Bhadra = month 5
        $this->assertSame(25,   $bs->getDay());
    }

    public function test_from_ad_preserves_time(): void
    {
        $ad = new \DateTime('2024-09-10 14:35:00');
        $bs = NepaliDate::fromAd($ad);

        $this->assertSame(14, $bs->getHour());
        $this->assertSame(35, $bs->getMinute());
        $this->assertSame(0,  $bs->getSecond());
    }

    // -----------------------------------------------------------------------
    // toAd()
    // -----------------------------------------------------------------------

    public function test_to_ad_converts_back_correctly(): void
    {
        $bs  = new NepaliDate(2081, 5, 25, 0, 0, 0, 'Asia/Kathmandu');
        $ad  = $bs->toAd();

        $this->assertSame('2024-09-10', $ad->format('Y-m-d'));
    }

    // -----------------------------------------------------------------------
    // parse()
    // -----------------------------------------------------------------------

    public function test_parse_ymd_format(): void
    {
        $date = NepaliDate::parse('2081-05-25');

        $this->assertSame(2081, $date->getYear());
        $this->assertSame(5,    $date->getMonth());
        $this->assertSame(25,   $date->getDay());
    }

    public function test_parse_single_digit_month(): void
    {
        $date = NepaliDate::parse('2083-5-12');

        $this->assertSame(2083, $date->getYear());
        $this->assertSame(5,    $date->getMonth());
        $this->assertSame(12,   $date->getDay());
    }

    public function test_parse_with_time(): void
    {
        $date = NepaliDate::parse('2081-05-25 14:30:00');

        $this->assertSame(14, $date->getHour());
        $this->assertSame(30, $date->getMinute());
        $this->assertSame(0,  $date->getSecond());
    }

    public function test_parse_throws_on_invalid_string(): void
    {
        $this->expectException(NepaliDateFormatException::class);

        NepaliDate::parse('not-a-date');
    }

    // -----------------------------------------------------------------------
    // createFromFormat()
    // -----------------------------------------------------------------------

    public function test_create_from_format_padded_month(): void
    {
        $date = NepaliDate::createFromFormat('Y-m-d', '2081-05-25');

        $this->assertSame(2081, $date->getYear());
        $this->assertSame(5,    $date->getMonth());
        $this->assertSame(25,   $date->getDay());
    }

    public function test_create_from_format_unpadded_month(): void
    {
        $date = NepaliDate::createFromFormat('Y-n-d', '2083-5-12');

        $this->assertSame(2083, $date->getYear());
        $this->assertSame(5,    $date->getMonth());
        $this->assertSame(12,   $date->getDay());
    }

    public function test_create_from_format_with_12h_time(): void
    {
        $date = NepaliDate::createFromFormat('Y-n-d g:i A', '2083-5-12 10:00 AM');

        $this->assertSame(10, $date->getHour());
        $this->assertSame(0,  $date->getMinute());
    }

    public function test_create_from_format_pm_conversion(): void
    {
        $date = NepaliDate::createFromFormat('Y-n-d g:i A', '2083-5-12 2:30 PM');

        $this->assertSame(14, $date->getHour());
        $this->assertSame(30, $date->getMinute());
    }

    public function test_create_from_format_throws_on_mismatch(): void
    {
        $this->expectException(NepaliDateFormatException::class);

        NepaliDate::createFromFormat('Y-m-d', 'not-a-date');
    }

    // -----------------------------------------------------------------------
    // format()
    // -----------------------------------------------------------------------

    public function test_format_ymd(): void
    {
        $date = new NepaliDate(2081, 5, 25);

        $this->assertSame('2081-05-25', $date->format('Y-m-d'));
    }

    public function test_format_with_month_name(): void
    {
        $date = new NepaliDate(2081, 5, 25);

        $this->assertSame('Bhadra', $date->format('F'));
    }

    public function test_format_readable(): void
    {
        $date = new NepaliDate(2081, 5, 25, 23, 45, 0);

        $formatted = $date->format('Y-m-d h:i:s A');
        $this->assertStringContainsString('2081', $formatted);
        $this->assertStringContainsString('PM', $formatted);
    }

    // -----------------------------------------------------------------------
    // Locale
    // -----------------------------------------------------------------------

    public function test_get_month_name_english(): void
    {
        $this->assertSame('Bhadra', NepaliDate::monthName(5, 'en'));
    }

    public function test_get_month_name_nepali(): void
    {
        $this->assertSame('भाद्र', NepaliDate::monthName(5, 'np'));
    }

    public function test_get_short_month_name(): void
    {
        $this->assertSame('Bha', NepaliDate::shortMonthName(5, 'en'));
    }

    public function test_get_week_name(): void
    {
        $this->assertSame('Sunday', NepaliDate::weekName(1, 'en'));
    }

    public function test_get_locale_months_returns_12(): void
    {
        $months = NepaliDate::getMonths('en');

        $this->assertCount(12, $months);
        $this->assertSame('Baisakh', $months[0]);
    }

    public function test_locale_switch_on_instance(): void
    {
        $date = new NepaliDate(2081, 5, 25);
        $date->setLocale('np');

        $this->assertSame('np', $date->getLocale());
        $this->assertSame('भाद्र', $date->getLocaleMonthName());
    }

    // -----------------------------------------------------------------------
    // Arithmetic
    // -----------------------------------------------------------------------

    public function test_add_days(): void
    {
        $date   = new NepaliDate(2081, 5, 25);
        $result = $date->addDays(5);

        $this->assertSame(30, $result->getDay());
    }

    public function test_sub_months(): void
    {
        $date   = new NepaliDate(2081, 5, 25);
        $result = $date->subMonths(2);

        $this->assertSame(3, $result->getMonth());
    }

    public function test_add_years(): void
    {
        $date   = new NepaliDate(2081, 5, 25);
        $result = $date->addYears(1);

        $this->assertSame(2082, $result->getYear());
    }

    // -----------------------------------------------------------------------
    // Comparison
    // -----------------------------------------------------------------------

    public function test_is_before(): void
    {
        $earlier = new NepaliDate(2081, 1, 1);
        $later   = new NepaliDate(2081, 6, 1);

        $this->assertTrue($earlier->isBefore($later));
        $this->assertFalse($later->isBefore($earlier));
    }

    public function test_is_after(): void
    {
        $earlier = new NepaliDate(2081, 1, 1);
        $later   = new NepaliDate(2081, 6, 1);

        $this->assertTrue($later->isAfter($earlier));
        $this->assertFalse($earlier->isAfter($later));
    }

    public function test_equal_to(): void
    {
        $a = new NepaliDate(2081, 5, 25);
        $b = new NepaliDate(2081, 5, 25);

        $this->assertTrue($a->equalTo($b));
    }

    public function test_between(): void
    {
        $date  = new NepaliDate(2081, 5, 15);
        $start = new NepaliDate(2081, 5, 1);
        $end   = new NepaliDate(2081, 5, 30);

        $this->assertTrue($date->isBetween($start, $end));
    }

    // -----------------------------------------------------------------------
    // Boundaries
    // -----------------------------------------------------------------------

    public function test_start_of_month(): void
    {
        $date   = new NepaliDate(2081, 5, 25);
        $result = $date->startOfMonth();

        $this->assertSame(1, $result->getDay());
        $this->assertSame(0, $result->getHour());
    }

    public function test_end_of_day(): void
    {
        $date   = new NepaliDate(2081, 5, 25);
        $result = $date->endOfDay();

        $this->assertSame(23, $result->getHour());
        $this->assertSame(59, $result->getMinute());
        $this->assertSame(59, $result->getSecond());
    }

    public function test_start_of_year(): void
    {
        $date   = new NepaliDate(2081, 5, 25);
        $result = $date->startOfYear();

        $this->assertSame(1, $result->getMonth());
        $this->assertSame(1, $result->getDay());
    }

    // -----------------------------------------------------------------------
    // Immutability
    // -----------------------------------------------------------------------

    public function test_mutable_modifies_in_place(): void
    {
        $date     = new NepaliDate(2081, 5, 25);
        $modified = $date->addDays(5);

        // Mutable — same object reference returned
        $this->assertSame($date, $modified);
    }

    public function test_to_immutable_returns_immutable_instance(): void
    {
        $date      = new NepaliDate(2081, 5, 25);
        $immutable = $date->toImmutable();

        $this->assertInstanceOf(NepaliDateImmutable::class, $immutable);
    }

    public function test_immutable_does_not_modify_original(): void
    {
        $immutable = new NepaliDateImmutable(2081, 5, 25);
        $modified  = $immutable->addDays(5);

        $this->assertSame(25, $immutable->getDay()); // original unchanged
        $this->assertSame(30, $modified->getDay());  // new instance changed
        $this->assertNotSame($immutable, $modified);
    }

    // -----------------------------------------------------------------------
    // Timezone
    // -----------------------------------------------------------------------

    public function test_default_timezone_is_kathmandu(): void
    {
        $this->assertSame('Asia/Kathmandu', NepaliDate::getDefaultTimeZoneName());
    }

    public function test_set_default_timezone(): void
    {
        NepaliDate::setDefaultTimeZoneName('UTC');
        $this->assertSame('UTC', NepaliDate::getDefaultTimeZoneName());

        // Restore
        NepaliDate::setDefaultTimeZoneName('Asia/Kathmandu');
    }

    public function test_from_timestamp(): void
    {
        $timestamp = mktime(0, 0, 0, 9, 10, 2024); // 2024-09-10 UTC
        $date      = NepaliDate::fromTimestamp($timestamp, 'Asia/Kathmandu');

        $this->assertInstanceOf(NepaliDate::class, $date);
        $this->assertSame(2081, $date->getYear());
    }

    // -----------------------------------------------------------------------
    // toDateString()
    // -----------------------------------------------------------------------

    public function test_to_date_string(): void
    {
        $date = new NepaliDate(2081, 5, 25);

        $this->assertSame('2081-05-25', $date->toDateString());
    }

    // -----------------------------------------------------------------------
    // getDaysInMonth()
    // -----------------------------------------------------------------------

    public function test_get_days_in_month_returns_positive_integer(): void
    {
        $date = new NepaliDate(2081, 1, 1);
        $days = $date->getDaysInMonth();

        $this->assertGreaterThanOrEqual(28, $days);
        $this->assertLessThanOrEqual(32, $days);
    }
}