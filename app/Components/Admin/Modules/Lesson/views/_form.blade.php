<div class='col-md-12'>
    <input type='text' name='title' placeholder='Title' required class='form-control'/>
</div>
<div class='col-md-12'>
    <input type='text' name='description' id="tinydesc" placeholder='Description' required class='form-control' />
</div>
<div class="col-md-12">
    <label for="begin-file">Begin File</label>
    <input type="file" name="begin_file" id="begin-file">
</div>
<div class="col-md-12">
    <label for="finish-file">Finish File</label>
    <input type="file" name="finish_file" id="finish-file">
</div>
<div class="col-md-12">
    <label for="vdo-file">Video File</label>
    <input type="file" name="vdo_file" id="vdo-file">
</div>

<div class='col-md-12 text-center'>
    {!! Form::submit($btTitle, ['class' => 'btn btn-default']) !!}
</div>