<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="form-alert"></span>
                <form method="post" id="userForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div id="alert">
                    </div>
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="username" class="control-label col-md-4">Username<span class="text-danger"> *</span></label>
                        <div class="col-md-12">
                            <input type="text" name="username" id="username" class="form-control" />
                            <p style="color:red; display: none" class="error errorUsername"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="full_name" class="control-label col-md-4">Full Name : </label>
                        <div class="col-md-12">
                            <input type="text" name="full_name" id="full_name" class="form-control" />
                            <p style="color:red; display: none" class="error errorFullName"></p>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label col-md-4">Email<span class="text-danger"> *</span></label>
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" class="form-control" />
                            <p style="color:red; display: none" class="error errorEmail"></p>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="age" class="control-label col-md-4">Age: </label>
                        <div class="col-md-12">
                            <input type="text" name="age" id="age" class="form-control" />
                            <p style="color:red; display: none" class="error errorAge"></p>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12">Select Profile Image : </label>
                        <div class="col-md-12">
                            <input type="file" name="avatar" id="avatar" onchange="loadFile(event)" />
                            <!--  onchange="document.getElementById('showiamge').src = window.URL.createObjectURL(this.files[0])" de input hien thi anh -->
                            <p style="color:red; display: none" class="error errorImage"></p>
                            <img id="showiamge" alt="your avatar upload" width="200" height="200" />
                            <span id="store_image"></span>
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <!-- <input type="hidden" name="hidden_id" id="hidden_id" /> -->
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning col-12" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>