<div class="contents" id="top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Manage Category</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-element">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default card-md mb-4">
                                <div class="card-header">
                                    <h6>Add Category</h6>
                                </div>
                                <div class="card-body pb-md-50">
                                    <div class="row">
                                    <div class="col-lg-6" >
                                    <form id="category_form">
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-row mx-n15">
                                            <div class="col-md-6 mb-20 px-15">
                                                <label for="validationDefault01" class="il-gray fs-14 fw-500 align-center">Title</label>
                                                <input type="text" class="form-control ih-medium ip-light radius-xs b-light" placeholder="Enter Title" required="" name="title" id="title">
                                            </div>
                                            <div class="col-md-6 mb-20 px-15">
                                                <label for="validationDefault02" class="il-gray fs-14 fw-500 align-center">Image (200x200px)</label>
                                                <a style="width: 100%;" href="javascript:void(0)" class="btn btn-lg btn-outline-lighten btn-upload" onclick="$('#image').click()"> <span data-feather="upload"></span> Click to Upload</a>
                                                <input type="file" required="" class="form-control  ih-medium ip-light radius-xs b-light" name="image" id="image" style="opacity: 0;position: absolute;" onchange="showSelectedImage(this)">
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="form-row mx-n15">
                                            <div class="col-md-12 mb-20 px-15">
                                                <label for="validationDefault012" class="il-gray fs-14 fw-500 align-center">Description</label>
                                                <textarea class="form-control  ih-medium ip-light radius-xs b-light"  placeholder="Enter Description" required="" name="description" id="description"></textarea>
                                            </div>
                                        </div>
                                        <div id="show_image"></div>
                                        <button class="btn btn-primary px-30 float-right mt-4" type="submit" id="button">Add Category</button>
                                    </form>
                                </div>
                                <div class="col-lg-6 p-2" id="addcode" style="border:1px solid #e3e6ef"><img src="{{url('images/placeholder.png')}}"></div>
                            </div>
                            </div>

                                
                            </div>
                            <!-- ends: .card -->
                        </div>
                        
                        <div class="col-12 mt-20">
                        <div class="card mb-25">
                            <div class="card-header">
                                <h6>All Category</h6>
                            </div>
                            <div class="card-body pt-0 pb-0">
                                <div class="drag-drop-wrap">
                                    <div class="table-responsive table-revenue w-100 mb-30">
                                        <table class="table mb-0 table-basic" id="category_datatable" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ends: card -->

                    </div>
                    </div>
                </div>

                

            </div>

        </div>

