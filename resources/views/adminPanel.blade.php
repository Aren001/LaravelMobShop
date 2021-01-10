
<h1>AdminPanel</h1>

<b><a href="/">Back to HOME</a></b>
<hr>
<a href="/logout">LogOut</a>
<hr>
<h1>Product List</h1>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Price</td>
        <td>Category</td>
        <td>Description</td>
        <td>Photo</td>
    </tr>

    @foreach($products as $item)

    <tr>
        <td>{{$item['id']}}</td>
        <td>{{$item['name']}}</td>
        <td>{{$item['price']}}</td>
        <td>{{$item['category']}}</td>
        <td>{{$item['description']}}</td>
        <td><img src="" alt={{$item['id']}}></td>
        <!-- 2 DEVNEL ashxatuma -->
        <!-- <td><a href="delete/{{$item->id}}" >DELETE</a></td>  --> 
        <td><a href={{"delete/" . $item["id"]}} >DELETE</a></td>
        <td ><a href={{"editPanel/" . $item["id"]}} >EDIT</a></td>
      
    </tr>

    @endforeach


   

</table>
<br><br>
<hr>
<b><h1>ADD PRODUCT</h1></b>


<form action="adminPanel" method="POST" > 
    @csrf
    <input type="text" name="name" placeholder="Name" ><br><br>
  
    <input type="text" name="price" placeholder="Price" ><br><br>

    <input type="text" name="category" placeholder="Category" ><br><br>

    <input type="text" name="description" placeholder="Description" ><br><br>

    <input type="text" name="gallery"><br><br>
   
  
    <button  type="submit">ADD</button>
</form>





