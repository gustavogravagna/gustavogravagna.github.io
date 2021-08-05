const input = document.querySelector(".task_input");
const btn = document.querySelector(".task_button").addEventListener('click', addlist);

function addlist () {
    const notCompleted = document.querySelector(".notCompleted");
    const Completed = document.querySelector(".Completed");

    const newLi = document.createElement("li");
    const delBtn = document.createElement("button");
    const checkBtn = document.createElement("button");

    delBtn.innerHTML = '<div class="delBtn"><i class="far fa-trash-alt"></i></div>';
    checkBtn.innerHTML = '<div class="chkBtn"><i class="fas fa-check"></i></div>';

    if (input.value !== '') {
        newLi.textContent = input.value;
        input.value = '';
        notCompleted.appendChild(newLi);
        newLi.appendChild(delBtn);
        newLi.appendChild(checkBtn);
    }

    checkBtn.addEventListener('click', function(){
        const parent = this.parentNode;
        parent.remove();
        Completed.appendChild(parent);
        checkBtn.style.display = 'none';
    });

    delBtn.addEventListener('click', function(){
        const parent = this.parentNode;
        parent.remove();
    });

}