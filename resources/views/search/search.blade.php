 <div class=" jumbotron" style="background-image:url(&quot;/img/background.jpg&quot;);background-size:cover;background-repeat:no-repeat;height:100%;background-color:#4d3c06;">
        <div style="height:200px;">
            <form class="form-inline" method="post" action="{{route('search')}}" style="background-position:center;margin:auto;padding:auto;margin-top:100px;">
                <div class="form-group" style="background-color:rgba(139,139,139,0);margin-left:100px;">
                    <input class="form-control form-control-lg" type="search" name="county" placeholder="Which county" style="margin:20px;">
                    <select class="form-control form-control-lg" style="font-size:20px;" name="type">
                        <option value="">Select residence type</option>
                        <option value="apartment">Apartment</option>
                        <option value="bedsitter">Bedsitter</option>
                        <option value="hostel">Hostel</option>
                        <option value="motel">Motel</option>
                    </select>
                    <button class="btn btn-success btn-lg"  type="submit" style="margin:20px;background-size:auto;">Search</button>
                </div>
            </form>
        </div>
    </div>