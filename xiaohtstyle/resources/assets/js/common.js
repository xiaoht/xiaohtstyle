$(document).ready(function () {
    $('#flash-overlay-modal').modal();
    if ($('#container').length){
        var ue = UE.getEditor('container' , {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' }
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            ue.setHeight(200);
        });
    }

    function formateTopic(topic) {
        return "<div class='select2-result-repository clearfix'>" + "<div class='select2-result-repository__meta'>" + "<div class='select2-result-repository__title'>" + topic.name ? topic.name : "Laravel" + "</div></div></div>";
    }
    function formatTopicSelection(topic) {
        return topic.name || topic.text;
    }

    $(".js-example-placeholder-multiple").select2({
        tags: true,
        placeholder: '请选择话题',
        minimumInputLength: 2,
        ajax: {
        url: '/api/topics',
            dataType: 'json',
            delay: 250,
            data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data, params) {
            return {
                results: data
            };
        },
        cache: true
        },
        templateResult: formateTopic,
            templateSelection: formatTopicSelection,
            escapeMarkup: function (markup) {
            return markup;
        }
    });
})