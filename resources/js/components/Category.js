import React,{Component} from 'react';
import ReactDOM from 'react-dom';

class Category extends Component{

    render(){
        return(
            <h1>Hello</h1>
        );
    }
}


export default Category;

if (document.getElementById('content')) {
    ReactDOM.render(<Category />, document.getElementById('content'));
}

//  function clickForImage() {
//    $('#pictures').click();
//   }
// function clickForImg() {
//    $('#image').click();
//   }



