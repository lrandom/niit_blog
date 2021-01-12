<h1>
	Kết quả
</h1>

@if(count($nghiem) == 0)
	<p>Phương trình vô nghiệm</p>
@elseif(count($nghiem) == 1)
	<p>Phương trình nghiệm kép {{ $nghiem[0] }}</p>
@else
	<p>Phương trình có 2 nghiệm</p>
	<p>X1= {{ $nghiem[0] }}</p>
	<p>X2= {{ $nghiem[1] }}</p>
@endif