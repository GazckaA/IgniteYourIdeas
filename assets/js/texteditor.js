//on document ready
$(document).ready(function () {

    const content = document.getElementById('content');

    content.addEventListener('mouseenter', function () {
        const a = content.querySelectorAll('a');
        a.forEach(item=> {
            item.addEventListener('mouseenter', function () {
                content.setAttribute('contenteditable', false);
                item.target = '_blank';
            })
            item.addEventListener('mouseleave', function () {
                content.setAttribute('contenteditable', true);
            })
        })
    })


    const showCode = document.getElementById('show-code');
    let active = false;

    showCode.addEventListener('click', function () {
        showCode.dataset.active = !active;
        active = !active
        if(active) {
            content.textContent = content.innerHTML;
            content.setAttribute('contenteditable', false);
        } else {
            content.innerHTML = content.textContent;
            content.setAttribute('contenteditable', true);
        }
    })

    $('#filename').on('keyup', function () {
        document.title = $(this).val();
        $('#title').html($(this).val());
    });

});

function addImage() {
    const url = prompt('Insert url');
    formatDoc('insertImage', url);
    let elements = document.querySelectorAll('img');

    for (let elem of elements) {
        elem.setAttribute("style", "max-width:100%");
    }
}

function addLink() {
    const url = prompt('Insert url');
    formatDoc('createLink', url);
}

function fileHandle(value) {
    if(value === 'new') {
        content.innerHTML = '';
        filename.value = 'untitled';
    } else if(value === 'txt') {
        const blob = new Blob([content.innerText])
        const url = URL.createObjectURL(blob)
        const link = document.createElement('a');
        link.href = url;
        link.download = `${filename.value}.txt`;
        link.click();
    } else if(value === 'pdf') {
        html2pdf(content).save(filename.value);
    }
}

function formatDoc(cmd, value=null) {
    if(value) {
        document.execCommand(cmd, false, value);
    } else {
        document.execCommand(cmd);
    }
}