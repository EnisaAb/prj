<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Admin
                            <small>Subheading</small>
                        </h1>
                        <?php
                        // $user = new User();
                        // $user->username = "almaaa";
                        // $user->password = "12";
                        // $user->first_name = "almaa";
                        // $user->last_name = "Abazi";
                        // $user->create();
                        $user=User::find_users_byId(4);
                        $user->password = "almaaa";
                        $user->update();
                        ?>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
</div>
            <!-- /.container-fluid -->