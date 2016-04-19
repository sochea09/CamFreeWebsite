<div class='col-md-12'>
    <label class="leble-stye">Title<span class="sty-sky">*</span></label>
    {!! Form::text('title', null, ['class'=>'form-control', 'required']) !!}
</div>
<div class="col-md-12">
    {!! Form::select('lesson_category', ['0' => '--category--'] + @$cats, @$cat_id, array('class' => 'form-control che-box', 'id' => 'cats', Input::old('cats'))) !!}
</div>
<div class='col-md-12'>
    <label class="leble-stye">Description<span class="sty-sky">*</span></label>
    {!! Form::textarea('description', null, ['class'=>'form-control','id' => 'tinydesc']) !!}
</div>
<div class="col-md-12 upload-main">
    <div class="input-group col-xs-6">
          <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
          <input type="text" id="progress" class="form-control input-lg" disabled placeholder="Upload Begin File">
          <span class="input-group-btn">
            <button class="browse btn btn-primary input-lg" type="button" onclick="loadUploadFile(this);"><i class="glyphicon glyphicon-search"></i> Browse</button>
          </span>
    </div>
    <input type="hidden" name="begin_file" id="upload-file">
</div>
<div class="col-md-12 upload-main">
    <div class="input-group col-xs-6">
        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
        <input type="text" id="progress" class="form-control input-lg" disabled placeholder="Upload Finish File">
          <span class="input-group-btn">
            <button class="browse btn btn-primary input-lg" type="button" onclick="loadUploadFile(this);"><i class="glyphicon glyphicon-search"></i> Browse</button>
          </span>
    </div>
    <input type="hidden" name="finish_file" id="upload-file">
</div>
<div class="col-md-12 upload-main">
    <div class="input-group col-xs-6">
        <span class="input-group-addon"><i class="glyphicon glyphicon-film"></i></span>
        <input type="text" class="form-control input-lg" disabled placeholder="Upload Video File">
          <span class="input-group-btn">
            <button class="browse btn btn-primary input-lg" type="button" onclick="loadUploadYoutube(this);"><i class="glyphicon glyphicon-search"></i> Browse</button>
          </span>
    </div>
    <input type="hidden" name="vdo_file" id="vdo-file">
</div>

<div class='col-md-12 text-center'>
    {!! Form::submit($btTitle, ['class' => 'btn btn-default']) !!}
</div>