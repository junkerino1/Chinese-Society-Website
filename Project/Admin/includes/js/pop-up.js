let previewContainer = document.querySelector('.menu-preview');
let previewBox = previewContaine.querySelector('.preview');
let editButtons = document.querySelectorAll('.edit-event-btn');

previewContainer.computedStyleMap.display = 'none';

function showPopUp(target){
    previewContainer.computedStyleMap.display = 'flex';
    previewBox.dataset.target = target;
    previewBox.classList.add('active');
}

editButtons.forEach(editBtn =>{
    editBtn.onclick = () => {
        let target = editBtn.parentNode.getAttribute('data-name');
    };
});

previewContainer.querySelector('.fa-times').onclick = () =>{
    previewBox.classList.remove('active');
    previewContainer.computedStyleMap.display = 'none';
};