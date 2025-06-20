<?php
$page_title = 'Register';
ob_start();
?>
<section class="bg-very-light-gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="p-13 md-p-10 bg-white contact-form-style-04">
                    <h3 class="d-inline-block fw-600 text-dark-gray mb-8 ls-minus-1px">Register</h3>
                    <form action="index.php?route=register" method="post">
                        <label class="text-dark-gray mb-10px fw-500">Full name<span class="text-red">*</span></label>
                        <input class="mb-20px bg-very-light-gray form-control required" type="text" name="full_name" placeholder="Enter your full name" />
                        <label class="text-dark-gray mb-10px fw-500">Email address<span class="text-red">*</span></label>
                        <input class="mb-20px bg-very-light-gray form-control required" type="email" name="email" placeholder="Enter your email" />
                        <label class="text-dark-gray mb-10px fw-500">Phone</label>
                        <input class="mb-20px bg-very-light-gray form-control" type="text" name="phone" placeholder="Enter your phone" />
                        <label class="text-dark-gray mb-10px fw-500">Password<span class="text-red">*</span></label>
                        <input class="mb-20px bg-very-light-gray form-control required" type="password" name="password" placeholder="Enter your password" />
                        <label class="text-dark-gray mb-10px fw-500">Type</label>
                        <input class="mb-20px bg-very-light-gray form-control" type="text" name="type" placeholder="Enter user type" />
                        <div class="position-relative terms-condition-box text-start d-inline-block mb-20px">
                            <label><input type="checkbox" name="is_active" value="1" class="check-box align-middle" checked> Active</label>
                        </div>
                        <button class="btn btn-large btn-round-edge btn-dark-gray btn-box-shadow w-100 mb-20px" type="submit">Register now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../templates/base.php';
?>
