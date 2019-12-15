<div id="formModalCreatePost" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-title">Create Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="form-alert"></span>
                <form method="post" id="CreatePostForm" action="#" enctype="multipart/form-data">
                    <!-- @CSRF -->
                    <div class="form-group">
                        <label for="title" class="control-label col-md-4">Title<span class="text-danger"> *</span></label>
                        <div class="col-md-12">
                            <input type="text" name="title" id="title" class="form-control" />
                            <p style="color:red; display: none" class="error errorTitle"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content" class="control-label col-md-4">Content<span class="text-danger"> *</span></label>
                        <div class="col-md-12">
                            <textarea type="text" style="height:200pxs" name="content" id="content" class="form-control"></textarea>
                            <p style="color:red; display: none" class="error errorContent"></p>

                        </div>
                    </div>
                
                    <br />
                    <input type="submit" name="action_creat_post" id="action_creat_post" class="btn btn-outline-primary float-right" value="Create Post" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>