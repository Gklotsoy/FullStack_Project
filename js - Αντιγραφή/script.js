var loginModal    = document.getElementById('loginModal');
var registerModal = document.getElementById('registerModal');
var newPostModal  = document.getElementById('newPostModal');

var newPostBtn    = document.getElementById('newPostBtn');


if (newPostBtn) {
    
    document.getElementById('newPostBtn').onclick = function() {
        document.getElementById('newPostModal').style.display = 'block';
        
    }   
    
    document.getElementsByClassName('close')[2].onclick = function() {
        newPostModal.style.display = 'none';
    }   

    window.onclick = function(event) {
        if (event.target == newPostModal) {
            newPostModal.style.display = 'none';
        }
    }
    

}else{

    document.getElementById('loginBtn').onclick = function() {
        document.getElementById('loginModal').style.display = 'block';
    }

    document.getElementById('registerBtn').onclick = function() {
        document.getElementById('registerModal').style.display = 'block';
    }

    document.getElementsByClassName('close')[0].onclick = function() {
        loginModal.style.display = 'none';
    }
    
    document.getElementsByClassName('close')[1].onclick = function() {
        registerModal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == loginModal) {
            loginModal.style.display = 'none';
        }
        if (event.target == registerModal) {
            registerModal.style.display = 'none';
        }
    }
}

document.getElementById('postForm').addEventListener('submit', function(e) {
    e.preventDefault();
    tinymce.triggerSave();
    this.submit();
});


tinymce.init({
    selector: 'textarea',
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});

