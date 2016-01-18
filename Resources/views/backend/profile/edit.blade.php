@extends('layouts.master')

@section('title')
    {{ trans('user::profile.title.profile') }}
@endsection
@section('subTitle')
    {{ $user->present()->fullname }}
@endsection

@section('content')

    <div class="ui grid">
        <div class="three wide column">
            <div class="ui vertical fluid tabular menu">

                <a data-tab="profile"
                   class="item active">
                    @lang('user::profile.title.profile')
                </a>

                <a data-tab="contact"
                   class="item">
                    @lang('user::profile.title.contact information')
                </a>

                <a data-tab="password"
                   class="item">
                    @lang('user::profile.title.password')
                </a>

            </div>
        </div>
        <div class="thirteen wide stretched column" id="profileContainer">
            @include('user::backend.profile.partials.profile')
            @include('user::backend.profile.partials.contact')
            @include('user::backend.profile.partials.password')
        </div>
    </div>


@endsection

@section('javascript')
    <script>$('.tabular.menu .item').tab();</script>
    <script>

        var dragAndDropModule = new fineUploader.DragAndDrop({
            dropZoneElements: [document.getElementById('profileContainer')],
            callbacks: {
                processingDroppedFilesComplete: function (files, dropTarget) {
                    fineUploaderBasicInstanceImages.addFiles(files);
                }
            }
        });

        var fineUploaderBasicInstanceImages = new fineUploader.FineUploaderBasic({
            button: document.getElementById('uploadImageButton'),
            request: {
                endpoint: '{{ apiRoute('v1', 'api.user.profile.store', ['profile' => $user->id])}}',
                inputName: 'image',
                customHeaders: {
                    "Authorization": "Bearer {{$jwtoken}}"
                }
            },
            callbacks: {
                onComplete: function (id, name, responseJSON) {
                    VueInstanceImage.complete(responseJSON)
                },
                onUpload: function () {
                    $('#uploadImageButton').hide();
                    $('#uploadInProgress').show();
                },
                onAllComplete: function (succeeded, failed) {
                    $('#uploadImageButton').show();
                    $('#uploadInProgress').hide();
                }
            }
        });

        $('#uploadInProgress').hide();
        VueInstanceImage = new Vue({
            el: '#profileContainer',
            data: {},
            ready: function () {

            },
            methods: {
                complete: function (responseJSON) {
                    $('#userProfilePicture').attr("src", responseJSON.data.thumbnail.square);
                    $('#sidebarUserProfilePicture').attr("src", responseJSON.data.thumbnail.square);
                }
            }

        });


    </script>
@endsection
