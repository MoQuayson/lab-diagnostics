import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import UpdateAppointmentModal from './modals/UpdateAppointmentModal';
import DeleteAppointmentModal from './modals/DeleteAppointmentModal';
import axios from "axios";
import Pagination from "react-js-pagination";


class AdminAppointment extends Component{
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

    FormSubmit(e){
        e.preventDefault();
    }

    TableHeader=()=>{
        return (
            <thead className="table-dark">
               <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Schedule</th>
                    <th scope="col">Status</th>
                    <th scope="col" style={{width:'160px'}}>Actions</th>
                </tr>
            </thead>
        );
    }

    BindAppointmentId(id) {
        document.getElementById('appointment_id').value = id;

    }

    SetAppointmentDetails(id,date){
        document.getElementById('update_appointment_id').value = id;
        document.getElementById('update_schedule').value = date;
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
                        No Appointments scheduled
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
                        <tr key={array_index}>
                            <td className='fw-bold' >{(((current_page-1) * total) + (index+1))}</td>
                            <td>{item.name}</td>
                            <td>{item.schedule}</td>
                            <td>{item.status}</td>
                            <td>
                            <a className="btn btn-sm btn-primary shadow me-1" href='#' role={'button'} data-bs-target={'#UpdateAppointment'} data-bs-toggle='modal' onClick={this.SetAppointmentDetails.bind(this,item.id,item.schedule)}><i className="fas fa-edit"></i></a>
                            <a className="btn btn-sm btn-danger shadow" href='#' role={'button'} data-bs-target={'#DeleteAppointment'} data-bs-toggle='modal' onClick={this.BindAppointmentId.bind(this,item.id)}><i className="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    ))

                );

            }
        }
    }

    //fetch details
    DataFetch(){

        var url = window.location.origin + '/admin/get-appointments';
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

        /*axios.get(url).then((response)=>{
            console.log(response.data);
            this.setState({
                //error: null,
                isloaded: true,
                data: response.data.data,

            })
        });*/
    }


    componentDidMount() {
        this.DataFetch();
    }

    handlePageChange(pageNumber) {
        this.setState({activePage: pageNumber});
        axios.get('/admin/get-appointments?page='+pageNumber).then((response)=>{
          this.setState({
            data:response.data.data,
            itemsCountPerPage:response.data.per_page,
            totalItemsCount:response.data.total,
            activePage:response.data.current_page

          })
        })
    }


    /*componentDidUpdate(){
        var rdBtnValue = document.querySelector('input[name="rdbtn"]:checked').value
        this.DataFetch(rdBtnValue);
    }*/

    render(){
        const { data, error, isloaded, value, status } = this.state;
        //console.log(typeof(data));
        return(
            <div className='card mb-5 shadow'>
                <div className="card-header">
                    <h5 className="text-primary">Appointment List</h5>
                </div>

                <div className="card-body p-0">
                    <table className="table table-responsive-md table-hover table-striped shadow">
                        <this.TableHeader/>
                        <tbody>
                        <this.TableDetails items={data} isloaded = {isloaded} />
                        </tbody>
                    </table>
                </div>

                <UpdateAppointmentModal isAdmin={true}/>
                <DeleteAppointmentModal isAdmin={true}/>

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

export default AdminAppointment;

if (document.getElementById('admin_appointment_list')) {
    ReactDOM.render(<AdminAppointment />, document.getElementById('admin_appointment_list'));
}
