/**
 * Created by nimrodcohen on 09/02/2018.
 */
$(document).ready(function () {
    var inElement = null;
    $(".email-designer .block").on('dragstart', function (ev) {
        var blockId = $(ev.target).data('block');
        ev.originalEvent.dataTransfer.setData("text", blockId);
    });

    $(".drag-receiver").on('dragover',function(ev)
    {
        ev.preventDefault();

        if(inElement != null)
            return;

        inElement = this;
        $(this).addClass("dragging-in");
    });

    $(".drag-receiver").on('dragleave dragend',function(ev)
    {
        ev.preventDefault();

        $(this).removeClass("dragging-in");
        inElement = null;
    });

    $(".drag-receiver").on('drop',function(ev) {

        ev.preventDefault();

        $(this).removeClass("dragging-in");
        inElement = null;

        var blockId = ev.originalEvent.dataTransfer.getData("text");

        if(blockId == "Text")
        {
            $(ev.target).append("<div class='draggable text-editor'>This is a text block</div>")
            var editor = $(ev.target).find(".text-editor");
            editor.on('click',function(){
                $(this).summernote(
                    {
                        airMode : false,
                        /*                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['insert',['ltr','rtl']],
                            ['insert', ['link','picture', 'video', 'hr']],
                            ['view', ['fullscreen', 'codeview']]
                        ]*/
                    });
            });
            editor.on('leave',function(){
                $(this).summernote('destroy');
            });
        }
    });
})