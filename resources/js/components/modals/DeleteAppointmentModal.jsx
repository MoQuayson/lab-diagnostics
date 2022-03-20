import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const DeleteAppointmentModal= (props)=>{

    const FormSubmit = (e)=>{
        e.preventDefault();
    }

    const DisplayModal = ()=>{
        if(props.isAdmin)
        {
            return(
                <AdminDeleteModal/>
            );
        }

        else
        {
            return(
                <UserDeleteModal/>
            );
        }
    }

    //Admin modal
    const AdminDeleteModal = ()=>{
        return(
            <div className="modal fade" id="DeleteAppointment" data-bs-backdrop="static" tabIndex="-1">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <form action="#" onSubmit={FormSubmit.bind(this)} method="POST" encType="multipart/form-data">
                            <div className="modal-header">
                            <h5 className="modal-title" id="assignment_title">Delete Appointment</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div className='modal-body p-3'>
                                <input type={'hidden'} id='appointment_id' name='appointment_id'></input>
                                <p>Are you sure you want to delete this user's appointment schedule?</p>
                            </div>
                            <div className="modal-footer border-0">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="deletebtn" type="button" className="btn btn-success" onClick={AdminDeleteAppointment.bind(this)}>Delete Appointment</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        );
    }
    //user modal
    const UserDeleteModal = ()=>{
        return(
            <div className="modal fade" id="DeleteAppointment" data-bs-backdrop="static" tabIndex="-1">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <form action="#" onSubmit={FormSubmit.bind(this)} method="POST" encType="multipart/form-data">
                            <div className="modal-header">
                            <h5 className="modal-title" id="assignment_title">Delete Appointment</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div className='modal-body p-3'>
                                <input type={'hidden'} id='appointment_id' name='appointment_id'></input>
                                <p>Are you sure you want to delete your appointment schedule?</p>
                            </div>
                            <div className="modal-footer border-0">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="deletebtn" type="button" className="btn btn-success" onClick={DeleteAppointment.bind(this)}>Delete Appointment</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        );
    }

    //functions for crud operations
    const AdminDeleteAppointment=()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/admin/appointment/'+document.getElementById('appointment_id').value;
        fetch(url, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            //body: JSON.stringify(body)
        })

        .then(res => res.json())
        .then(
            (result) => {

                window.location.reload();

            },
            (error) => {
                console.log(error);
            }
        );
    }

    const DeleteAppointment=()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/appointment/'+document.getElementById('appointment_id').value;
        fetch(url, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            //body: JSON.stringify(body)
        })

        .then(res => res.json())
        .then(
            (result) => {

                window.location.reload();

            },
            (error) => {
                console.log(error);
            }
        );
    }

    return(
        <DisplayModal/>
    );
}

export default DeleteAppointmentModal;
