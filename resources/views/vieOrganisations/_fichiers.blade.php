<form action="{{ route('fichier-documents.add') }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
    @csrf
    <input type="hidden" name="code_doc" id="code_doc" value="">
    <div class="">
        <input name="" id="" class="btn btn-primary " type="submit" value="Quitter">
    </div>

</form>

<style>
    .dropzone {
        background: #e3e6ff;
        border-radius: 13px;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
        border: 2px dotted #1833FF;
        margin-top: 50px;
    }
</style>
<script>
    Dropzone.options.imageUpload = {
        maxFilesize: 2024,
        acceptedFiles: "image/*, audio/*, video/*, .pdf, .docx, .xls, .ppt",
        dictDefaultMessage: "Cliquez ici pour joindre vos fichiers",
    };
</script>
