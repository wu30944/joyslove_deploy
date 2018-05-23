<div class="mail" id="mail">
    <div class="container">
        <h3>與就是愛聯絡</h3>
        <div class="mail_grids_wthree_agile_info">
            <div class="col-md-7 mail_grid_right_agileits_w3">
                <h5>Please fill this form to contact with us.</h5>
                <form action="#" method="post">
                    <div class="col-md-6 col-sm-6 contact_left_grid">
                        <input type="text" name="Name" placeholder="Name" required="">
                        <input type="email" name="Email" placeholder="Email" required="">
                    </div>
                    <div class="col-md-6 col-sm-6 contact_left_grid">
                        <input type="text" name="Telephone" placeholder="Telephone" required="">
                        <input type="text" name="Subject" placeholder="Subject" required="">
                    </div>
                    <div class="clearfix"> </div>
                    <textarea name="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
                    <input type="submit" value="Submit">
                    <input type="reset" value="Clear">
                </form>
            </div>
            <div class="col-md-5 contact-left">
                <h5>Contact Info</h5>
                <div class="visit">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-home" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Visit us</h4>
                        <p>{{$About['address']}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="mail-us">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-envelope" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Mail us</h4>
                        <p><a href="{{$About['email']}}">{{$About['email']}}</a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="visit">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-phone" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Call us</h4>
                        <p>{{$About['telephone']}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="visit">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-clock-o" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Work hours</h4>
                        <p>Mon-Sat 09:00 AM - 05:00PM</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>