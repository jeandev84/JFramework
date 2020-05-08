<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="<?= route('home') ?>" class="navbar-brand">
                <?= env('APP_NAME')?>
            </a>
        </div>

        <!-- left menu -->
        <ul class="nav navbar-nav">
            <li>
                <a href="<?= route('home')?>">
                    <span class="glyphicon glyphicon-home"></span>
                    Home
                </a>
            </li>
            <li>
                <a href="<?= route('product.list')?>">
                    <span class="glyphicon glyphicon-modal-window"></span>
                    Product
                </a>
            </li>
            <li style="width: 300px;left: 10px;top: 10px;">
                <input type="text" class="form-control" id="search">
            </li>
            <li style="top: 10px;left: 20px;">
                <input type="submit" class="btn btn-primary" id="search_btn">
            </li>
        </ul>
        <!--/-- end left menu -->

        <!-- right menu -->
        <ul class="nav navbar-nav navbar-right">
            <li>
                <? //= route('cart')?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    Cart <span class="badge">0</span>
                </a>
                <div class="dropdown-menu" style="width: 400px;">
                     <div class="panel panel-success">
                         <div class="panel-heading">
                             <div class="row">
                                 <!-- serial number -->
                                 <div class="col-md-3">Sl.No</div>
                                 <div class="col-md-3">Product Image</div>
                                 <div class="col-md-3">Product Name</div>
                                 <div class="col-md-3">Price in $.</div>
                             </div>
                         </div>
                         <div class="panel-body"></div>
                         <div class="panel-footer"></div>
                     </div>
                </div>
            </li>
            <li>
                <? //= route('auth.signin')?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>
                    Signin
                </a>

                <!-- Drop down -->
                <ul class="dropdown-menu">
                   <div style="width:300px;">
                       <div class="panel panel-primary">
                           <div class="panel-heading">Login</div>
                           <div class="panel-heading">
                               <label for="email">
                                   Email
                               </label>
                               <input type="email" class="form-control" id="email" required>
                               <label for="password">Password</label>
                               <input type="password" class="form-control" id="password" required>
                               <p><br></p>
                               <a href="#" style="color: white; list-style: none;">Forgetten Password</a>
                               <input type="submit" class="btn btn-success" style="float: right;" id="login" value="Login">
                           </div>
                           <div class="panel-info" id="e_msg"></div>
                       </div>
                   </div>
                </ul>
                <!--/ end Drop down -->
            </li>
            <li>
                <a href="<?= route('auth.signup')?>">
                    <span class="glyphicon glyphicon-user"></span>
                    Signup
                </a>
            </li>
        </ul>
        <!--/-- end right menu -->

    </div>
</div>
<p><br></p>
<p><br></p>
<p><br></p>