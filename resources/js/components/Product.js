import React,{Component} from 'react';
import {BASE_URL} from '../constants';
import {connectWallet} from '../commonAction';
import ReactDOM from 'react-dom';

class Product extends Component{

    constructor() {
        super();
        this.state = { brand: [] , category : []};
      }

      async componentDidMount() {
        const response1 = await fetch(BASE_URL+'getdata/tbl_brand');
        const json1 = await response1.json();
        this.setState({ brand: json1 });
        const response2 = await fetch(BASE_URL+'getdata/tbl_category');
        const json2 = await response2.json();
        this.setState({ category: json2 });
      }
    
    render(){
        return(
         <div className="container-fluid">
                <div className="row">
                    <div className="col-lg-12">
                        <div className="breadcrumb-main">
                            <h4 className="text-capitalize breadcrumb-title">Manage Products</h4>
                            <button className="btn btn-primary" onClick="connectWallet()">Connect</button>
                            <div className="breadcrumb-action justify-content-center flex-wrap">
                            </div>
                        </div>

                    </div>
                </div>
                <div className="form-element">
                    <div className="row">
                        <div className="col-lg-12">
                            <div className="card card-default card-md mb-4">
                                <div className="card-header">
                                    <h6>Add Products</h6>
                                </div>
                                <div className="card-body pb-md-50">
                                    <form id="product_form" >
                                        <input type="hidden" name="id" id="id" />
                                        <div className="form-row mx-n15">
                                            <div className="col-md-4 mb-20 px-15">
                                                <label htmlFor="title" className="il-gray fs-14 fw-500 align-center">Title</label>
                                                <input type="text" className="form-control ih-medium ip-light radius-xs b-light" placeholder="Enter Title" required="" name="title" id="title" />
                                            </div>
                                            <div className="col-md-4 mb-20 px-15">
                                                <label htmlFor="category" className="il-gray fs-14 fw-500 align-center">Select Category</label>
                                                 <select className="custom-select form-control select-arrow-none ih-medium  radius-xs b-light shadow-none color-light  fs-14"  required="" name="category" id="category">
                                                    <option value="">Select Category</option>
                                                    {this.state.category.map(el => (
                                                        <option key={el.id} value={el.id}>
                                                          {el.title}
                                                        </option>
                                                      ))}
                                                </select>
                                            </div>
                                            <div className="col-md-4 mb-20 px-15">
                                                <label htmlFor="subcategory" className="il-gray fs-14 fw-500 align-center">Select SubCategory</label>
                                                <div id="addsubcategory">
                                                    <div className="atbd-select-list" >
                                                        <div className="atbd-select">
                                                            <select className="form-control " required="" name="subcategory" id="subcategory">
                                                            <option value="">Select SubCategory</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div className="form-row mx-n15">
                                            <div className="col-md-4 mb-20 px-15">
                                                <label htmlFor="brand" className="il-gray fs-14 fw-500 align-center">Select Brand</label>
                                                 <select className="custom-select form-control select-arrow-none ih-medium  radius-xs b-light shadow-none color-light  fs-14"  required="" name="brand" id="brand">
                                                    <option value="">Select Brand</option>
                                                     {this.state.brand.map(el => (
                                                        <option key={el.id} value={el.id}>
                                                          {el.title}
                                                        </option>
                                                      ))}
                                                </select>
                                            </div>
                                            <div className="col-md-4 mb-20 px-15">
                                                <label htmlFor="price" className="il-gray fs-14 fw-500 align-center">Price</label>
                                                <input type="text" className="form-control ih-medium ip-light radius-xs b-light" placeholder="Enter Price" required="" name="price" id="price" />
                                            </div>
                                            <div className="col-md-4 mb-20 px-15">
                                                <label htmlFor="lottery_type" className="il-gray fs-14 fw-500 align-center">Lottery Type</label>
                                                  <select className="custom-select form-control select-arrow-none ih-medium  radius-xs b-light shadow-none color-light  fs-14"  required="" name="lottery_type" id="lottery_type">
                                                    <option value="">Select Lottery Type</option>
                                                    <option value="1">Time Based</option>
                                                    <option value="2">Threshold Based</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div className="form-row mx-n15" id="addNewColumn">
                                            
                                            <div className="col-md-8 mb-20 px-15">
                                                <label htmlFor="short_desc" className="il-gray fs-14 fw-500 align-center">Short description</label>
                                                <textarea className="form-control  ih-medium ip-light radius-xs b-light"  placeholder="Enter Short Description" required="" name="short_desc" id="short_desc"></textarea>
                                            </div>

                                        </div>
                                        <div className="form-row mx-n15">
                                            <div className="col-md-4 mb-20 px-15">
                                                <label htmlFor="pictures" className="il-gray fs-14 fw-500 align-center">Image </label>
                                                <a style={{width: "100%"}} href="#!" className="btn btn-lg btn-outline-lighten btn-upload" onClick={clickForImage}> <span data-feather="upload"></span> Click to Upload</a>
                                                <input type="file" className="form-control  ih-medium ip-light radius-xs b-light" name="pictures[]" id="pictures" style={{opacity: "0",position: "absolute"}} multiple />
                                            </div>
                                            <div className="col-md-8 mb-20 px-15" ><div className="row"  id="showimgp"></div></div>
                                            <div id="showimgupdated">
                                                
                                            </div>
                                        </div>
                                        <div className="form-row mx-n15">
                                            <div className="col-md-12 mb-20 px-15">
                                                <label htmlFor="description" className="il-gray fs-14 fw-500 align-center">Description</label>
                                                <textarea className="form-control  ih-medium ip-light radius-xs b-light"  placeholder="Enter Description"  id="description" ></textarea>
                                            </div>
                                        </div>
                                        <div className="form-row mx-n15" id="addColumn">
                                            
                                                <label htmlFor="title" className="il-gray fs-14 fw-500 ml-3">Specifications</label>
                                                <div className="col-md-12 mb-20 px-15 row">
                                                    <div className="col-md-3">
                                                        <input type="text" className="form-control ih-medium ip-light radius-xs b-light" placeholder="Enter Key" required="" name="key[]" id="key" />
                                                    </div>
                                                    <div className="col-md-3">
                                                        <input type="text" className="form-control ih-medium ip-light radius-xs b-light" placeholder="Enter Value" required="" name="value[]" id="value" id="fimg" />
                                                    </div>
                                                        <input type="hidden" name="updateimg[]" id="updateimg" />
                                                   
                                                    <div className="col-md-4" id="showimage">
                                                        <div className="row">
                                                            <div className="col-md-10 mb-20 px-15">  <a style={{width: "100%"}} href="#!" className="btn btn-lg btn-outline-lighten btn-upload" onClick={clickForImg}> <span data-feather="upload"></span> Click to Upload</a> <input type="file" required="" className="form-control  ih-medium ip-light radius-xs b-light" name="image[]" id="image" style={{opacity: "0",position: "absolute"}} onChange = {(e) => {showSelectedImage(e.target.files);} } /> 
                                                            </div>
                                                            <div className="col-md-2" id="showimg"></div>
                                                        </div>
                                                    </div>
                                                    <div className="col-md-2">
                                                        <span className="btn btn-success float-right" id="addSpecification"  style={{fontSize: "25px",height: "36px",width: "11px"}}>+</span>
                                                    </div>
                                                </div>

                                            
                                        </div>
                                        <div id="show_image"></div>
                                        <button className="btn btn-primary px-30 float-right mt-4" type="submit" id="button" >Save Product</button>
                                    </form>
                                </div>
                            </div>
                         
                        </div>

                    </div>
                </div>
           
                <div className="col-12 mt-20">
                        <div className="card mb-25">
                            <div className="card-header">
                                <h6>All Products</h6>
                            </div>
                            <div className="card-body pt-0 pb-0">
                                <div className="drag-drop-wrap">
                                    <div className="table-responsive table-revenue w-100 mb-30">
                                        <table className="table mb-0" id="product_datatable" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Completion</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        );
    }
}


export default Product;

if (document.getElementById('content')) {
    ReactDOM.render(<Product />, document.getElementById('content'));
}

 function clickForImage() {
   $('#pictures').click();
  }
function clickForImg() {
   $('#image').click();
  }



