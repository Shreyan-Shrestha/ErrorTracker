// Opens Modal: create_modal_
window.OpenCreateModal =function(action, modalId = 'modal_create') {
    document.getElementById('create_form_' + modalId).action = action;
    document.getElementById(modalId).showModal();
}

//Opens Modal: modal_edit_
window.OpenEditModal = function(btn) {
    const modalId = btn.dataset.modal;
    document.getElementById('create_form_' + modalId).action = btn.dataset.action;
    document.getElementById(modalId).showModal();

    Object.entries(btn.dataset).forEach(([key, value]) => {
        const field = document.querySelector('#' + modalId + ' [name="' + key + '"]');
        if (field) field.value = value;
    });
}

// Opens Modal delete
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.getElementById('delete_form').action = this.dataset.action;
        modal_delete.showModal();
    });
});

// Auto dismiss Alert 
['alert-success', 'alert-error', 'alert-form-error'].forEach(id => {
    const btn = document.getElementById(id);
    if (btn) setTimeout(() => btn.remove(), 5000);
  });

// Auto Opens create modal if Validation Error occurs
const modalId = document.getElementById('modal-error-target')?.dataset.modal;
if (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.showModal();
}
