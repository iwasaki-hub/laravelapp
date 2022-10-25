<form  action="/rest" method="POST">
    @csrf
    <table>
        <tr>
            <th>Message:</th>
            <td>
                <input type="text" name="message" value="{{old('message')}}">
            </td>
        </tr>
    
        <tr>
            <th>Url:</th>
            <td>
                <input type="url" name="url" value="{{old('url')}}">
            </td>
        </tr>
    
        <tr>
            <th></th>
            <td>
                <input type="submit" value="add">
            </td>
        </tr>
    </table>
</form>