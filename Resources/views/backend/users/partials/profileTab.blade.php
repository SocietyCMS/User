
<h4 class="ui dividing header">@lang('user::profile.profile.picture')</h4>
<div class="field" id="profileContainer">
    <div class="ui grid">
        <div class="two wide column">
            <img class="ui small bordered image" src="{{ $user->present()->avatar }}"
                 id="userProfilePicture">
        </div>
        <div class="fourteen wide column">

            <a class="ui basic button" id="uploadImageButton">
                @lang('user::profile.profile.upload new profile picture')
            </a>
            <div class="ui basic loading button" id="uploadInProgress">Loading</div>
            <p> @lang('core::messages.info.upload picture by drag and drop')</p>

        </div>

    </div>
</div>


<h4 class="ui dividing header">@lang('user::profile.title.address information')</h4>

<div class="field {{ $errors->has('title') ? 'error' : '' }}">
    <label for="gender">@lang('user::profile.profile.title')</label>

    <div class="ui search selection dropdown additions">
        <input name="title" type="hidden" value="{{ old('title', isset($user)?$user->title:null ) }}">
        <i class="dropdown icon"></i>
        <div class="text">{{ old('title', isset($user)?$user->title:null ) }}</div>
        <div class="menu">
            @foreach(trans('user::users.personTitle') as $key => $lang )
                <div class="item" data-value="{{$lang}}">{{$lang}}</div>
            @endforeach
        </div>
    </div>

    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('street') ? 'error' : '' }}">
    <label for="street">@lang('user::profile.profile.street')</label>
    <input type="text"
           id="street"
           name="street"
           value="{{ old('street', isset($user)?$user->street:null) }}"
          >

    {!! $errors->first('street', '<span class="help-block">:message</span>') !!}
</div>

<div class="two fields">
    <div class="four wide field {{ $errors->has('zip') ? 'error' : '' }}">
        <label for="zip">@lang('user::profile.profile.zip')</label>
        <input type="text"
               id="zip"
               name="zip"
               value="{{ old('zip', isset($user)?$user->zip:null) }}"
               >

        {!! $errors->first('zip', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="twelve wide field {{ $errors->has('city') ? 'error' : '' }}">
        <label for="city">@lang('user::profile.profile.city')</label>
        <input type="text"
               id="city"
               name="city"
               value="{{ old('city', isset($user)?$user->city:null) }}"
               >

        {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
    </div>
</div>



<div class="field {{ $errors->has('country') ? 'error' : '' }}">
    <label for="country">@lang('user::profile.profile.country')</label>
    <input type="text"
           id="country"
           name="country"
           value="{{ old('country', isset($user)?$user->country:null) }}"
           >

    {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
</div>


<h4 class="ui dividing header">@lang('user::profile.title.user information')</h4>

<div class="field {{ $errors->has('office') ? 'error' : '' }}">
    <label for="office">@lang('user::profile.profile.office')</label>
    <input type="text"
           id="office"
           name="office"
           value="{{ old('office', isset($user)?$user->office:null) }}"
           >

    {!! $errors->first('office', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('bio') ? 'error' : '' }}">
    <label for="bio">@lang('user::profile.profile.bio')</label>
    <input type="text"
           id="bio"
           name="bio"
           value="{{ old('bio', isset($user)?$user->bio:null) }}"
           >

    {!! $errors->first('bio', '<span class="help-block">:message</span>') !!}
</div>



<h4 class="ui dividing header">@lang('user::profile.title.contact information')</h4>

<div class="field {{ $errors->has('phone') ? 'error' : '' }}">
    <label for="phone">@lang('user::profile.profile.phone')</label>
    <input type="text"
           id="phone"
           name="phone"
           value="{{ old('phone', isset($user)?$user->phone:null) }}"
           >

    {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('mobile') ? 'error' : '' }}">
    <label for="mobile">@lang('user::profile.profile.mobile')</label>
    <input type="text"
           id="mobile"
           name="mobile"
           value="{{ old('mobile', isset($user)?$user->mobile:null) }}"
           >

    {!! $errors->first('mobile', '<span class="help-block">:message</span>') !!}
</div>

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
                "Authorization": "Bearer " + societycms.jwtoken
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
            }
        }

    });
</script>
