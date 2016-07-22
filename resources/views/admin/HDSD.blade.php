@extends('admin.master')
@section('controller','Hướng dẫn sử dụng')
@section('action','')
@section('content')
<ol class="breadcrumb">
    <li class="active">
    <a href="{!!URL::route('dashboard')!!}">
        <i class="glyphicon glyphicon-dashboard"></i> Dashboard
    </a>
    </li>
    <li class="active">
        <i class="glyphicon glyphicon-book"></i> Document
    </li>
</ol>
<div class="col-lg-11">
  <h3>Đổi mật khẩu</h3>
  <hr>
  @if(Auth::user()->username=="admin")
  <h4>
  Khi bạn nhận được tài khoản admin cung cấp ban đầu , có username và mật khẩu mặc định là: 
 <h4 class="text-primary"> username = "admin", 
  password = "admin123" </h4>
  <h4>Để đảm bảo tính an toàn cho hệ thống, điều bạn cần làm trước tiên chính là đổi mật khẩu cho tài khoản này , và nhớ mật khẩu , tài khoản admin này rất quan trọng , bởi sau này bạn có thể dùng nó để thiết lập lại các tài khoản khác nếu không may có mất
  </h4>
  @endif
  <h4>
  	Đổi mật khẩu cho tài khoản bạn thực hiện theo các bước sau : Click vào <a href="{!!URL::route('getRepass')!!}" target="_blank">User->Đổi mật khẩu</a> sẽ hiện ra hình như sau :<br><br> <img src="{{url('admin/images/repass.png')}}">
  </h4>
  <br>
  <h4>
  	lúc này bạn chỉ cần nhập mật khẩu cũ mặc định ở trên và mật khẩu muốn đổi mới , nhấn vào Lưu , bạn đã đổi mật khẩu thành công
  </h4>
  <hr>
  @if(Auth::user()->level==1)
  <h3>Tạo tài khoản</h3>
  <hr>
  	<h4>Để tạo và cấp các tài khoản cho người dùng , thực hiện theo các bước sau : Click vào <a href="{!!URL::route('userAdd')!!}" target="_blank">User->Thêm User</a> , hiện ra như hình sau :<br><br><img src="{{url('admin/images/createUser.png')}}">
  	</h4>
  	<br>
  	<h4>
  		Nhập username, mật khẩu mà bạn muốn , phân quyền cho tài khoản , có 4 loại : <br>
  		<h4 class="text-primary">- Admin:</h4> <h4>Quyền cao nhất , thực hiện được mọi chức năng trong hệ thống, thêm, sửa, xóa user, thao tác với đơn hàng, sản phẩm vật liệu</h4>
  		<h4 class="text-primary">- Sale Admin:</h4> <h4>Có quyền hạn tương tự Admin nhưng không có quyền thêm , xóa , sửa User</h4>
  		<h4 class="text-primary">- Sale:</h4> <h4>thao tác chỉ giới hạn với đơn hàng , thêm sửa , xóa đơn hàng</h4>
  		<h4 class="text-primary">- Tech:</h4> <h4>Cũng có thao tác với mình đơn hàng nhưng chỉ xem được kết quả đơn hàng sau khi xử lý , và đem đi in kết quả</h4>
  		<h4>Tùy vào nhu cầu mà bạn muốn, bạn nhập username, phân quyền nhấn User Add là hoàn thành, lưu ý các username không được trùng lặp và không được đặt là "admin"</h4>
  	</h4>
  <hr>
  @endif
  <h3>Xem danh sách User</h3>
  <hr>
  <h4>
  	Click vào <a href="{!!URL::route('listUser')!!}" target="_blank">User->Danh sách User</a> sẽ được như hình sau : @if(Auth::user()->level==1)<br><br><img src="{{url('admin/images/listUser.png')}}" width="800 px" height="300px">
  	<h4>Tại đây bạn có thể xem danh sách các user và thực hiện các thao tác sửa, xóa, thực hiện thử để rõ hơn chi tiết</h4>
  	@else<br><br><img src="{{url('admin/images/listUser1.png')}}" width="800 px" height="300px">@endif
  </h4>
  <hr>
  @if(Auth::user()->level==1||Auth::user()->level==2||Auth::user()->level==3)
  
  <h3>Tạo đơn hàng</h3>
  <hr>
  <h4>
  	Click vào <a href="{!!URL::route('getDonhang')!!}" target="_blank">Đơn hàng ->Thêm đơn hàng</a> sẽ được hình như sau : <br><br><img src="{{url('admin/images/addDH.png')}}">
  </h4>
  <h4>
  	Bạn nhập tên khách hàng , chọn tên sản phẩm muốn thêm vào đơn hàng , cùng số lượng tương ứng ở bảng chi tiết, nếu sai hoặc không muốn nhập lại bạn có thể nhấn dấu x màu xanh ở khung để xóa hoặc muốn chọn thêm sản phẩm thì bạn có thể nhấp chuột vào ô chọn thêm sản phẩm , thì một bản ghi mới sẽ hiện thêm ra cho bạn chọn như hình dưới đây : <br><br><img src="{{url('admin/images/addDH1.png')}}">
  </h4>
  <h4>
  	Sau khi điền đầy đủ thông tin , bạn nhấp chuột vào nút thêm đơn hàng , đơn hàng sẽ được nhập vào hoàn thành
  </h4>
  <hr>
  @endif
  <h3>Xem danh sách Đơn hàng</h3>
  <hr>
  <h4>
  	Để xem danh sách đơn hàng , bạn click chuột vào <a href="{!!URL::route('listDh')!!}" target="_blank">Đơn hàng->Danh sách đơn hàng</a> , sẽ được hình như sau : 
  	@if(Auth::user()->level==1||Auth::user()->level==2)
  	<br><br><img src="{{url('admin/images/listDH.png')}}" width="800 px" height="500px"> 
  	@elseif(Auth::user()->level==3)
  	<br><br><img src="{{url('admin/images/listDH1.png')}}" width="800 px" height="500px">
  	@elseif(Auth::user()->level==4)
  	<br><br><img src="{{url('admin/images/listDH2.png')}}" width="800 px" height="500px">
  	@endif
  </h4>
  <h4>
  	Trong mục danh sách đơn hàng này , sẽ có mục tìm kiếm cho bạn tìm đơn hàng theo mã đơn hàng, tên khách hàng , người lập đơn, trạng thái , hạn giao hàng trong khoảng thời gian từ ngày nào đến ngày nào , ví dụ , tôi muốn tìm đơn hàng có mã hàng là DH29, trạng thái đã xử lý , chọn thông tin trong các ô rồi nhấp chuột vào nút tìm kiếm , kết quả hiện ra như sau :
  	@if(Auth::user()->level==1||Auth::user()->level==2)
  	 <br><br><img src="{{url('admin/images/searchDH.png')}}" width="800 px" height="350px"> 
  	@elseif(Auth::user()->level==3)
  	<br><br><img src="{{url('admin/images/searchDH1.png')}}" width="800 px" height="350px"> 
  	@endif
  </h4>
  @if(Auth::user()->level==1||Auth::user()->level==2)
  <h4>
  	Trong trang danh sách đơn hàng này hiện ra một bảng danh sách các đơn hàng đã được lập, đã xử lý và chưa xử lý, nếu bạn muốn xuất danh sách đơn hàng này ra file Excel bạn nhấp chuột vào button Xuất danh sách ra Excel , bạn sẽ được như ý, ngoài ra trên bảng còn có các tác vụ tương ứng của mỗi đơn hàng nằm ở cột cuối cùng của bảng, nếu đơn hàng chưa xử lý sẽ có tác vụ xử lý , còn khi đơn hàng đã xử lý thì bạn có thể xem kết quả bằng cách nhấp chuột vào button Kết quả màu xanh lá mạ
  </h4>
  @endif
  <h4>
  	Muốn xem kỹ thông tin hơn về đơn hàng bạn nhấp vào mỗi hàng của bảng trong danh sách , mỗi hàng sẽ hiện lên thông tin chi tiết về đơn hàng hơn như hình dưới đây : 
  	@if(Auth::user()->level==1||Auth::user()->level==2)
  	<br><br><img src="{{url('admin/images/detailDH.png')}}" width="800 px" height="350px">
  	@elseif(Auth::user()->level==3)
  	<br><br><img src="{{url('admin/images/detailDH2.png')}}" width="800 px" height="350px">
  	@elseif(Auth::user()->level==4)
  	<br><br><img src="{{url('admin/images/detailDH4.png')}}" width="800 px" height="350px">
  	@endif
  </h4>
  <h4>
  	Ở mỗi hàng chi tiết này , nếu muốn xem chi tiết của đơn hàng hơn , ta nhấp chuột vào chữ chi tiết màu xanh sẽ có kết quả : 
  	@if(Auth::user()->level==1||Auth::user()->level==2)
  	<br><br><img src="{{url('admin/images/detailDH1.png')}}">
  	@elseif(Auth::user()->level==3)
  	<br><br><img src="{{url('admin/images/detailDH3.png')}}">
  	@elseif(Auth::user()->level==4)
  	<br><br><img src="{{url('admin/images/detailDH5.png')}}">
  	@endif
  </h4>
  	@if(Auth::user()->level==1||Auth::user()->level==2||Auth::user()->level==3)
  <h4>
  	Ngoài ra , ở mỗi đơn hàng chưa được xử lý còn có thêm tác vụ xóa (button có biểu tượng thùng rác),và sửa(button có biểu tượng cây bút chì ở góc phải)
  </h4>
  @endif
  <hr>
  @if(Auth::user()->level==1||Auth::user()->level==2||Auth::user()->level==4)
  <h3>Xem kết quả đơn hàng</h3>
  <hr>
  <h4>
  	Như đã nói ở trên ,muốn xem kết quả đơn hàng đã xử lý , bạn vào danh sách đơn hàng , click vào button kết quả của đơn hàng để xem kết quả, sẽ được kết qủa như sau :  <br><br><img src="{{url('admin/images/resultDH.png')}}" width="800 px" height="350px">
  </h4>
  <h4>
  	Tương tự như các thao tác trong danh sách đơn hàng , nhưng ở đây ta có thêm tác vụ in kết quả bằng cách nhấp chuột vào button Print ở góc phải 
  </h4>
  @endif
  @if(Auth::user()->level==1||Auth::user()->level==2)
  <h4>
  	Trên đây là cách sử dụng và thao tác với đơn hàng , tương tự như vậy với sản phẩm và vật liệu, chúc bạn làm việc vui vẻ ^^
  </h4>
  @endif
</div>
@endsection