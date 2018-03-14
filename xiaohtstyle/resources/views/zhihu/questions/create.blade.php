@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('base.release question') }}</div>

                    <div class="panel-body">
                        <form action="/zhihu/questions" method="post">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">{{ trans('base.title') }}</label>
                                <input type="text" name="title" class="form-control" placeholder="{{ trans('base.title') }}" id="title" value="{{old('title')}}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <select  name="topics[]" class="js-data-example-ajax-ajax js-example-placeholder-multiple form-control" multiple="multiple">
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="container">{{ trans('base.content') }}</label>
                                <script id="container" name="content" type="text/plain">
                                    {!! old('content') !!}
                                </script>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right" type="submit">{{ trans('base.release question') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <!-- 实例化编辑器 -->
        <script type="text/javascript">
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
            $(document).ready(function () {
                function formateTopic(topic) {
                    return "<div class='select2-result-repository clearfix'>" + "<div class='select2-result-repository__meta'>" + "<div class='select2-result-repository__title'>" + topic.name ? topic.name : "Laravel" + "</div></div></div>";
                }
                function formatTopicSelection(topic) {
                    return topic.name || topic.text;
                }
                $(".js-example-placeholder-multiple").select2({
                    tags: true,
                    placeholder: '{{ trans('base.select topics') }}',
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
        </script>
    @endSection
@endsection
