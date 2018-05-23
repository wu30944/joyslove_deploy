<div class="reservation" id="book">
    <div class="book-form">
        <h4>Prearrange a Table.</h4>
        <form action="#" method="post">
            <div class="col-md-4 form-time">
                <label><i class="fa fa-clock-o" aria-hidden="true"></i></label>
                <input type="text" id="timepicker" name="Time" placeholder="Time" class="timepicker form-control hasWickedpicker" value="Time"
                       onkeypress="return false;" required="">
            </div>
            <div class="col-md-4 form-date">
                <label><i class="fa fa-calendar" aria-hidden="true"></i> </label>
                <input id="datepicker1" name="Text" type="text" value="mm/dd/yyyy" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}"
                       required="">
            </div>
            <div class="col-md-4 form-left">
                <label><i class="fa fa-users" aria-hidden="true"></i></label>
                <select class="form-control">
                    <option>No.of People</option>
                    <option>1 Person</option>
                    <option>2 People</option>
                    <option>3 People</option>
                    <option>4 People</option>
                    <option>5 People</option>
                    <option>More</option>
                </select>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-3 form-left">
                <ul>
                    <li><i class="fa fa-check-square-o" aria-hidden="true"></i>Over 10,000 restaurants Worldwide</li>
                    <li><i class="fa fa-check-square-o" aria-hidden="true"></i>No booking fees</li>
                </ul>
            </div>
            <div class="col-md-3 form-left-submit">
                <input type="submit" value="Book a table">
            </div>
            <div class="clearfix"> </div>
        </form>

    </div>

</div>