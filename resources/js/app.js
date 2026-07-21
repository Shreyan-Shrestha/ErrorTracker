//For SKeleton:
function skeletonHide() {
    const skeletonEl = document.getElementById('skeleton');
    const contentEl = document.getElementById('content');

    if (!skeletonEl || !contentEl) return;

    skeletonEl.classList.add('hidden');
    contentEl.classList.remove('hidden');
}

function skeletonShow() {
    const skeletonEl = document.getElementById('skeleton');
    const contentEl = document.getElementById('content');

    if (!skeletonEl || !contentEl) return;

    skeletonEl.classList.remove('hidden');
    contentEl.classList.add('hidden');
}

window.addEventListener('load', skeletonHide);
window.addEventListener('beforeunload', skeletonShow);

//Date Picker js
document.addEventListener('DOMContentLoaded', function () {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');

    if (!startTimeInput || !endTimeInput) return;

    const today = NepaliFunctions.BS.GetCurrentDate();

    function initStartPicker(maxDate = today) {
        startTimeInput.NepaliDatePicker("destroy");
        startTimeInput.NepaliDatePicker({
            language: "english",
            dateFormat: "DD/MM/YYYY",
            maxDate: maxDate,
            onSelect: function (date) {
                initEndPicker({
                    year: date.year,
                    month: date.month,
                    day: date.day
                });
            }
        });
    }

    function initEndPicker(minDate = null) {
        endTimeInput.NepaliDatePicker("destroy");
        const options = {
            language: "english",
            dateFormat: "DD/MM/YYYY",
            maxDate: today,
            onSelect: function (date) {
                initStartPicker({
                    year: date.year,
                    month: date.month,
                    day: date.day
                });
            }
        };
        if (minDate) options.minDate = minDate;
        endTimeInput.NepaliDatePicker(options);
    }

    startTimeInput.addEventListener('input', function () {
        if (this.value === '') initEndPicker();
    });

    endTimeInput.addEventListener('input', function () {
        if (this.value === '') initStartPicker();
    });

    initStartPicker();
    initEndPicker();
});
