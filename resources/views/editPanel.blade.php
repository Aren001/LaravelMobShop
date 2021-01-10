<h1>EDIT PRODUCT</h1>



<form action="/editPanel" method="POST" > 
    @csrf
    <!-- Partadira -->
    <input type="hidden" name="id" value="{{$data['id']}}">
    <input type="text" name="name" placeholder="Name" value="{{$data['name']}}" ><br><br>
  
    <input type="text" name="price" placeholder="Price" value="{{$data['price']}}"><br><br>

    <input type="text" name="category" placeholder="Category" value="{{$data['category']}}" ><br><br>

    <input type="text" name="description" placeholder="Description" value="{{$data['description']}}"><br><br>

    <input type="text" name="gallery" value="{{$data['gallery']}}"><br><br>
   
  
    <button type="submit">UPDATE</button>
</form>