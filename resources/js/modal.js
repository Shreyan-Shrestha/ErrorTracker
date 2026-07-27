// Opens Modal: create_modal_
window.OpenCreateModal = function (action, modalId = 'modal_create') {
    document.getElementById('create_form_' + modalId).action = action;
    const modal = document.getElementById(modalId);

    modal.querySelectorAll('input[type="checkbox"]').forEach( cb => {
        cb.checked = false;
        cb.ariaDisabled = false;
    });

    modal.querySelectorAll('li').forEach( li => li.style.display='block');
    updateBadges(modal);

    modal.showModal();
}

// Opens Modal: modal_edit_
window.OpenEditModal = function (btn) {
    const modalId = btn.dataset.modal;
    const modal = document.getElementById(modalId);
    
    document.getElementById('create_form_' + modalId).action = btn.dataset.action;
    modal.showModal();

    // Parse sub_projects array safely
    let subProjects = [];
    try {
        subProjects = JSON.parse(btn.dataset.sub_projects || "[]").map(String);
    } catch (e) {
        console.error("Failed to parse sub_projects");
    }

    const projectId = String(btn.dataset.id);

    // Populate standard text/select fields
    Object.entries(btn.dataset).forEach(([key, value]) => {
        // Skip special data attributes that aren't form fields
        if (['modal', 'action', 'id', 'sub_projects'].includes(key)) return;
        
        const field = modal.querySelector('[name="' + key + '"]');
        if (field) field.value = value;
    });

    // Handle Sub Projects Checkboxes
    const subProjectItems = modal.querySelectorAll('.sub-projects-list li');
    subProjectItems.forEach(li => {
        const checkbox = li.querySelector('input[type="checkbox"]');
        if(!checkbox) return;

        // Reset state
        li.style.display = 'block';
        checkbox.disabled = false;
        checkbox.checked = false;

        // If it's the current project, hide & disable it so it can't be selected
        if (checkbox.value === projectId) {
            li.style.display = 'none';
            checkbox.disabled = true;
        } 
        // If the project ID is in the subProjects array, check it
        else if (subProjects.includes(checkbox.value)) {
            checkbox.checked = true;
        }
    });

    // Update badges visually for this specific modal
    updateBadges(modal);
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

// --- BADGE LOGIC ---
// Scoped badge update function so create & edit modals don't clash
window.updateBadges = function(scope = document) {
    // Find containers ending in 'selected_projects'
    const badgeContainers = scope.querySelectorAll('[id$="selected_projects"]');
    
    badgeContainers.forEach(container => {
        container.innerHTML = '';
        
        // Find the closest wrapper
        const wrapper = container.closest('.fieldset');
        if (!wrapper) return;

        const checkboxes = wrapper.querySelectorAll('.sub-project-checkbox:checked');
        
        checkboxes.forEach(checkbox => {
            // Create the badge wrapper
            const badge = document.createElement('span');
            badge.className = 'badge badge-info badge-sm gap-2 flex items-center';
            badge.textContent = checkbox.dataset.name;
            
            // Create the X button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'cursor-pointer text-red-500 font-bold ml-1 hover:text-red-700';
            removeBtn.textContent = '✕';
            
            // Attach a click event directly to the button
            removeBtn.addEventListener('click', () => {
                checkbox.checked = false; // Uncheck the exact checkbox
                // Fire the change event so the list automatically updates
                checkbox.dispatchEvent(new Event('change', { bubbles: true }));
            });
            
            // Put it together
            badge.appendChild(removeBtn);
            container.appendChild(badge);
        });
    });
};

document.addEventListener('DOMContentLoaded', function () {
    updateBadges();
});

// Use event delegation for checkboxes so it works universally across all modals
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('sub-project-checkbox')) {
        updateBadges(e.target.closest('.fieldset'));
    }
});