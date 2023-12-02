//on document ready
$(document).ready(function () {

    var interval = setInterval(prueba,1000);

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

function formatDoc(cmd, value=null) {
    if(value) {
        document.execCommand(cmd, false, value);
    } else {
        document.execCommand(cmd);
    }
}

var img = "";

function addMainImgLink() {
    const url = prompt('Insert url');
    if(url === null) return;
    $('#portada').attr('src', url);
    img = 'url';
    //clear input file
    $('#inputArchivo').val('');
}

function uploadMainImg() {
    var inputArchivo = document.getElementById('inputArchivo');
    var vistaPrevia = document.getElementById('portada');
    if (inputArchivo.files && inputArchivo.files[0]) {
        var lector = new FileReader();
        lector.onload = function (e) {
            vistaPrevia.src = e.target.result;
        };
        lector.readAsDataURL(inputArchivo.files[0]);
    }
    img = 'file';
}

function save(){
    if(img=="")alert("Please upload/add a cover image");
    else if($('#filename').val() == "Title" || $('#filename').val() == "")alert("Please add a title");
    else if($('#tags').val() == "Tags" || $('#tags').val() == "")alert("Please add tags");      
    else{
        handleFileRead($('#inputArchivo')[0].files[0])
        .then(base64Data => {
            //disable buttons
            $("button").prop("disabled", true);
            $("input").prop("disabled", true);
            $("select").prop("disabled", true);
            $("textarea").prop("disabled", true);
            $("[onclick='save()']").addClass("bg-light");
            $("[onclick='save()']").removeAttr("onclick");
            $("[onclick='delete()']").addClass("bg-light");
            $("[onclick='delete()']").removeAttr("onclick");

            var image = base64Data;
            var content = $('#content').html();
            var title = $('#filename').val();
            var author = $('#author').html();
            var name = $('#name').html();
            var tags = $('#tags').val();
            var date = new Date().toLocaleString("en-US", {timeZone: "etc/GMT+8", dateStyle: "long", timeStyle: "short"});
            date += " (etc/GMT+8)";

            //objeto para mandar por ajax
            var formData = new FormData();
            formData.append('operation', 'save');
            formData.append('title', title);
            formData.append('author', author);
            formData.append('tags', tags);
            formData.append('date', date);
            formData.append('content', content);
            formData.append('authorName', name);
            if (img == 'url') {
                formData.append('image', $('#portada').attr('src')); 
            } else {   
                formData.append('image', image);
            }
            // console.log('Contenido de FormData:');
            // for (const entry of formData.entries()) {
            //     console.log(entry[0], entry[1]);
            // }
            $.ajax({
                url: 'BackEnd/controller.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    let cambio = data.substring(1);
                    if (cambio != "false") {
                        window.location.href = "post.php?id=" + cambio;
                    } else {
                        alert("Error saving post");
                    }
                }
            });
        })
    }
}

function handleFileRead(file) {
    return new Promise((resolve, reject) => {
        // Verificar si 'file' no es 'null'
        if (file != null) {
            const reader = new FileReader();

            // Configurar una función de devolución de llamada cuando se complete la lectura del archivo
            reader.onload = function (e) {
                resolve(e.target.result);
            };

            // Configurar una función de devolución de llamada en caso de error
            reader.onerror = function (error) {
                reject(error);
            };

            // Leer el contenido del archivo como una URL de datos (Base64)
            reader.readAsDataURL(file);
        } else {
            // Obtener la URL de la imagen #portada
            const imageUrl = $('#portada').attr('src');
            
            // Resolver la promesa con la URL de la imagen
            resolve(imageUrl);
        }
    });
}

function prueba() {
    $('#postdate').html(new Date().toLocaleString("en-US", {timeZone: "etc/GMT+8", dateStyle: "long", timeStyle: "short"}) + " (etc/GMT+8)");
}

function imgText() {
    if($('#imgText')[0].files[0] == null) return;
    handleFileRead($('#imgText')[0].files[0])
    .then(base64Data => {
        formatDoc('insertImage', base64Data);
        $('#imgText').val('');
        let elements = document.querySelectorAll('img');

        for (let elem of elements) {
            elem.setAttribute("style", "max-width:100%");
        }
    })
}