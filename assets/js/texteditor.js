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
if ($('#portada').attr('src') != "assets/img/gallery/gallery-2.jpg") img = "url";

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
        //disable buttons
        $("button").prop("disabled", true);
        $("input").prop("disabled", true);
        $("select").prop("disabled", true);
        $("textarea").prop("disabled", true);
        $('.color').removeAttr('onclick');
        $('.color').addClass('bg-light');

        var image = $('#portada').attr('src');
        var content = $('#content').html();
        var title = $('#filename').val();
        var author = $('#author').html();
        var name = $('#name').html();
        var tags = $('#tags').val().replace(/ /g, "").split(",");
        var date = new Date().toLocaleString("en-US", {timeZone: 'UTC', dateStyle: "long", timeStyle: "short"});
        date += " (UTC+00:00)";

        //objeto para mandar por ajax
        var formData = new FormData();
        formData.append('operation', 'save');
        formData.append('title', title);
        formData.append('author', author);
        formData.append('tags', tags);
        formData.append('date', date);
        formData.append('content', content);
        formData.append('authorName', name);
        formData.append('image', image);
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
                console.log(cambio);
                if (cambio != "false") {
                    window.location.href = "post.php?id=" + cambio;
                } else {
                    alert("Error saving post");
                }
            }
        });
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
    $('#postdate').html(new Date().toLocaleString("en-US", {timeZone: 'UTC', dateStyle: "long", timeStyle: "short"}) + " (UTC+00:00)");
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

function update(id){
    if(img=="")alert("Please upload/add a cover image");
    else if($('#filename').val() == "Title" || $('#filename').val() == "")alert("Please add a title");
    else if($('#tags').val() == "Tags" || $('#tags').val() == "")alert("Please add tags");      
    else{
        // const url = prompt("Are you sure you want to update this post? If so, please type the title of the post to confirm.");
        // if(url != $('#filename').val()) return;
        //disable buttons
        $("button").prop("disabled", true);
        $("input").prop("disabled", true);
        $("select").prop("disabled", true);
        $("textarea").prop("disabled", true);
        $('.color').removeAttr('onclick');
        $('.color').addClass('bg-light');

        var image = $('#portada').attr('src');
        var content = $('#content').html();
        var title = $('#filename').val();
        var tags = $('#tags').val().replace(/ /g, "").split(",");
        var date = new Date().toLocaleString("en-US", {timeZone: 'UTC', dateStyle: "long", timeStyle: "short"});
        date += " (UTC+00:00)";

        //objeto para mandar por ajax
        var formData = new FormData();
        formData.append('operation', 'updatePost');
        formData.append('id', id);
        formData.append('title', title);
        formData.append('tags', tags);
        formData.append('date', date);
        formData.append('content', content);
        formData.append('image', image);
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
                    window.location.href = "post.php?id=" + id;
                } else {
                    alert("Error saving post");
                }
            }
        });
    }
}

function deletePost(id){
    if(img=="")alert("Please upload/add a cover image");
    else if($('#filename').val() == "Title" || $('#filename').val() == "")alert("Please add a title");
    else if($('#tags').val() == "Tags" || $('#tags').val() == "")alert("Please add tags");      
    else{
        const url = prompt("Are you sure you want to delete this post? If so, please type the title of the post to confirm.");
        if(url != $('#filename').val()) return;
        //disable buttons
        $("button").prop("disabled", true);
        $("input").prop("disabled", true);
        $("select").prop("disabled", true);
        $("textarea").prop("disabled", true);
        $('.color').removeAttr('onclick');
        $('.color').addClass('bg-light');

        //objeto para mandar por ajax
        var formData = new FormData();
        formData.append('operation', 'deletePost');
        formData.append('id', id);
        $.ajax({
            url: 'BackEnd/controller.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                let cambio = data.substring(1);
                if (cambio != "false") {
                    window.location.href = "index.php";
                } else {
                    alert("Error deleting post");
                }
            }
        });
    }
}