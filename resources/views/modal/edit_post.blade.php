<div id="formModalEditPost" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-title">Edit Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="eform-alert"></span>
                <form id="EditPostForm" autocomplete="off" enctype="multipart/form-data">
                    @CSRF
                    <input type="hidden" id="post_id">
                    <div class="row">
                        <div class="form-group col-5">
                            <label for="title" class="control-label col-md-8">Image:</label>
                            <div class="col-md-12">
                                <img id="post-image" src="" style="width:auto;height:100px">
                                <input type="file" name="post-image" id="edit-image" style="font-size:14px" class="mt-1" onchange="choseImg(this)"/>
                                <p style="color:red; display: none" class="error erroreTitle"></p>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group col-12">
                                <label for="create-at" class="control-label col-md-8">Create at:</label>
                                <div class="col-md-12">
                                    <input type="text" name="create-at" id="ecreate_at" class="form-control" readonly="true" />
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="username" class="control-label col-md-8">Owners:</label>
                                <div class="col-md-12">
                                    <input type="text" name="username" id="username" class="form-control" readonly="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="control-label col-md-8">Title<span class="text-danger"> *</span></label>
                        <div class="col-md-12">
                            <input type="text" name="title" id="etitle" class="form-control"/>
                            <p style="color:red; display: none" class="error erroreTitle"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content" class="control-label col-md-4">Content<span class="text-danger"> *</span></label>
                        <div class="col-md-12">
                            <textarea type="text" name="content" id="econtent" class="form-control"></textarea>
                            <p style="color:red; display: none" class="error errorContent"></p>
                        </div>
                    </div>   

                    <br />
                    <input type="submit" name="action_edit_post" id="action_edit_post" class="btn btn-outline-primary float-right" value="Edit Post" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
