<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="../EducationInfo.css" rel="stylesheet">
<button id='btnEdit' onclick="edit()">Edit</button>
<p id="demo"></p>
<!-- Create the editor container -->
<div id="editor" style="height: 80%">
    <p>Hello COSMO Education!</p>
    <p>Education Information <strong>test</strong> text</p>
    <p><br></p>
</div>
<div>
    <button id='btnSave' onclick="logHtmlContent()" hidden="hidden">Save</button>
    <button id="btnCancel" onclick="cancel()" hidden="hidden">Cancel</button>
</div>
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    let clicked = false;
    function logHtmlContent() {
        document.getElementById('btnSave').hidden = false;
        console.log(quill.root.innerHTML);
    }
    function cancel(){
        document.getElementById('btnCancel').hidden = false;
        let txt;
        let r = confirm("Changes will not be saved.");
        if (r == true) {
            toolbarOptions = [];
            quill = [];
        } else {

        }
        document.getElementById("demo").innerHTML = txt;
    }
    function edit(){
        clicked = true;
        if(clicked === true){
            document.getElementById('btnEdit').hidden = true;
            document.getElementById('btnCancel').hidden = false;
            document.getElementById('btnSave').hidden = false;
        }
        else
        {
            document.getElementById('btnEdit').hidden = false;
        }
        toolbarOptions = [
            ['bold', 'italic', 'underline'],
            [{ 'size': ['small', false, 'large', 'huge'] }],
            [{ 'color': [] }, { 'background': [] }],
            ['image'],
            ['clean'],
            [{'font': []}]
        ]
        quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
    }
</script>
