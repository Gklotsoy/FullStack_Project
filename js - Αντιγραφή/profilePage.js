const profileDataDiv = document.getElementById('profileData');
const editBtn        = document.getElementById('editBtn');
const updateForm     = document.getElementById('updateForm');
const cancelBtn      = document.getElementById('cancelBtn');
const checkbox       = document.getElementById('checkbox');
const newPassword    = document.getElementById('newPassword');

editBtn.addEventListener('click', function() {
    profileDataDiv.classList.add('hidden');
    updateForm.classList.remove('hidden');

});

cancelBtn.addEventListener('click', function() {
    profileDataDiv.classList.remove('hidden');
    updateForm.classList.add('hidden');
    
});

checkbox.addEventListener('change', function() {
    if(checkbox.checked) {
        newPassword.classList.remove('hidden');
        newPassword.required = true;
    }
    else {
        newPassword.classList.add('hidden');
        newPassword.required = false;
    }
});
