import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import UpdateLabTestModal from './modals/UpdateLabTestModal';
import DeleteLabTestModal from './modals/DeleteLabTestModal';
import axios from "axios";
import Pagination from "react-js-pagination";
class LabTest extends Component{
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            error: null,
            isloaded: false,
            activePage:1,
            itemsCountPerPage:0,
            totalItemsCount:0,
            pageRangeDisplayed:0
        };

        this.handlePageChange=this.handlePageChange.bind(this);
    }

    FormSubmit(e) {
        e.preventDefault();
    }

    TableHeader=()=>{
        return (
            <thead className="table-dark">
               <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Test Name</th>
                    <th scope="col">Results</th>
                    <th scope="col">Price</th>
                    <th scope="col" style={{width:'160px'}}>Actions</th>
                </tr>
            </thead>
        );
    }

    BindLabTestId(id) {
        document.getElementById('test_id').value = id;
    }

    SetLabTestDetails(item){
        document.getElementById('update_test_id').value = item.id;
        document.getElementById('update_name').value = item.name;
        document.getElementById('update_price').value = item.price;
        document.getElementById('update_result').value = item.results;
    }

    TableDetails = (props) => {
        const items = props.items;
        const isloaded = props.loaded;
        //console.log(items);
        if (isloaded === false) {
            return (
                <tr>
                    <td className="text-center mx-auto" colSpan="12" style={{ color: 'blue' }}>
                        <div className="spinner-border spinner-border-sm text-primary me-2" role="status">
                        </div>
                        <span className='fs-5'>loading....</span>
                    </td>
                </tr>
            );
        }
        else {
            if (items.length === 0) {
                return (
                    <tr>
                        <td className="text-center" colSpan="12" style={{ color: 'red' }}>
                            No Details Found
                        </td>
                    </tr>
                );
            }
            else {
                var array_index = 1;
                var current_page = this.state.activePage;
                var total = this.state.itemsCountPerPage;
                return (
                    items.map((item, index) => (
                        <tr key={index}>
                            <td className='fw-bold' >{(((current_page-1) * total) + (index+1))}</td>
                            <td>{item.fullname}</td>
                            <td>{item.name}</td>
                            <td><a href={'/admin/lab-test/'+item.id}>{item.id}.pdf</a></td>
                            <td>{item.price}</td>
                            <td className='justify-content-between'>
                            <a className="btn btn-primary shadow me-1" href='#' role={'button'}
                            data-bs-target={'#UpdateTest'} data-bs-toggle='modal' onClick={this.SetLabTestDetails.bind(this,item)}
                            ><i className="fas fa-edit"></i></a>

                            <a className="btn btn-danger shadow" href='#' role={'button'}
                            data-bs-target={'#DeleteTest'} data-bs-toggle='modal' onClick={this.BindLabTestId.bind(this,item.id)}
                            ><i className="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    ))

                );

            }
        }
    }

    //fetch details
    DataFetch(){
        var url = window.location.origin + '/admin/get-tests';
        fetch(url)
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    //error: null,
                    isloaded: true,
                    data: result.data,
                    totalItemsCount:result.total,
                    itemsCountPerPage: result.data.length,
                    pageRangeDisplayed:Math.ceil(result.total/result.data.length)
                });
            },
            (error) => {
                this.setState({
                    isloaded: true,
                    error: error,
                    status: 'error'
                });
            }
        )
    }


    componentDidMount() {
        this.DataFetch();
    }
    /*componentDidUpdate(){
        var rdBtnValue = document.querySelector('input[name="rdbtn"]:checked').value
        this.DataFetch(rdBtnValue);
    }*/

    handlePageChange(pageNumber) {
        this.setState({activePage: pageNumber});
        axios.get('/admin/get-tests?page='+pageNumber).then((response)=>{
          this.setState({
            data:response.data.data,
            itemsCountPerPage:response.data.per_page,
            totalItemsCount:response.data.total,
            activePage:response.data.current_page
           
          })
        })
    }

    render(){
        const { data, error, isloaded, value, status } = this.state;
        console.log(data);
        console.log(error);
        return(
            <div className='card mb-5 shadow'>
                <div className="card-header">
                    <h5 className="text-primary">Lab Test List</h5>
                </div>

                <div className="card-body p-1">
                    <table className="table table-responsive shadow">
                        <this.TableHeader/>
                        <tbody>
                            <this.TableDetails items={data} isloaded = {isloaded} />
                        </tbody>
                    </table>
                </div>

                <UpdateLabTestModal isAdmin={true}/>
                <DeleteLabTestModal isAdmin={true}/>

                <div className="card-footer d-flex justify-content-end bg-white">
                    <Pagination
                        activePage={this.state.activePage}
                        itemsCountPerPage={this.state.itemsCountPerPage}
                        totalItemsCount={this.state.totalItemsCount}
                        pageRangeDisplayed={this.state.pageRangeDisplayed}
                        onChange={this.handlePageChange}
                        itemClass='page-item'
                        linkClass='page-link'
                    />
                </div>
            </div>
        );
    }
}

export default LabTest;

if (document.getElementById('admin_test_list')) {
    ReactDOM.render(<LabTest />, document.getElementById('admin_test_list'));
}
