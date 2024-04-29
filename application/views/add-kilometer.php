<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('partials/head-css') ?>
    <style>
        .sidebar {
            /* display: none; */
        }
        .page-wrapper {
            margin-left: 0px;
        }
        .date-picker {
            width: auto;
        }
    </style>
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/select2/css/select2.min.css">
</head>

<?php $this->load->view('partials/body') ?>


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-wrapper">
    <?php $this->load->view('partials/menu') ?>

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Kilometer</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>?/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>?/kilometer_master">Kilometer Master</a></li>
                                    <li class="breadcrumb-item active">Add Kilometer</li>
                                </ul>
                                <div class="mt-3">
                                    <a href="<?php echo base_url(); ?>?/kilometer_master"><button type="button" class="btn btn-primary"> ❮ Back</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="?/Phpspreadsheet/uploadfile" method="post" name="frmExcelImport" id="kilometerfile" enctype="multipart/form-data">

                                        <div class="mb-5">

                                            <label>Choose File</label> 

                                            <input type="file" name="file" id="file" accept=".xlsx">

                                            <button type="submit" id="submit" name="import" class="btn btn-primary">Import</button>

                                    

                                        </div>

                                    </form>
                                    <h4 class="card-title text-center">OR</h4>
                                    <form action="<?php echo base_url(); ?>?/home/save_kilometer" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="hidden" name="ID" value="<?php if(isset($edit)){ echo $edit[0]['ID'];}  ?>">
                                                    <input type="text" name="state" class="form-control" value="<?php if(isset($edit)){ echo $edit[0]['state']; }  ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Zone</label>
                                                    <input type="text" name="zone" class="form-control" value="<?php if(isset($edit)){ echo $edit[0]['zone']; }  ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Destination</label>
                                                    <input type="text" name="destination" class="form-control" value="<?php if(isset($edit)){ echo $edit[0]['destination']; }  ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kilometer</label>
                                                    <input type="text" name="kilometer" class="form-control" value="<?php if(isset($edit)){ echo $edit[0]['kilometer']; }  ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Transit Time</label>
                                                    <input type="text" name="transit_time" class="form-control" value="<?php if(isset($edit)){ echo $edit[0]['transit_time']; }  ?>">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-primary"><?php echo $title_meta['title'] ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Wrapper -->
    </div>
    <!-- end main content-->




<?php $this->load->view('partials/vendor-scripts') ?>
<script>
    $(document).ready( function(){
        $('#submit').click(function(){
            var formData = $('#kilometerfile').serialize()
            alert(formData)
            $.ajax({
                url: "Phpspreadsheet/uploadfile",
                type: "POST",
                method: "POST",
                data: formData,
                dataType: "JSON",
                success: function(response){
                    console.log(response)
                    
                },
                error: function(response){
                    console.log(response)
                }

            })
        })
    })
</script>
</body>

</html>