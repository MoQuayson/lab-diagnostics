import React, { Component } from 'react';
const UpdateAppointmentModal = (props)=>{

    const FormSubmit=(e)=>{
        e.preventDefault();
    }

    //display modal
    const DisplayModal = ()=>{
        if(props.isAdmin)
        {
            console.log(typeof(props.isAdmin));
            return(
                <AdminUpdateModal/>
            );
        }

        else
        {
            return(
                <UserUpdateModal/>
            );
        }
    }

    //Admin modal
    const AdminUpdateModal = ()=>{
        return (
            <div className="modal fade" id="UpdateAppointment" data-bs-backdrop="static" tabIndex="-1">
                <div className="modal-dialog modal-lg">
                    <div className="modal-content">
                        <form action="#"  method="POST" onSubmit={FormSubmit.bind(this)} encType="multipart/form-data">
                            <div className="modal-header">
                            <h5 className="modal-title" id="assignment_title">Change Appointment Schedule</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div className='modal-body p-3'>
                                <input type={'hidden'} id='update_appointment_id' name='update_appointment_id'></input>
                                <div className="col mb-3">
                                    <label className="form-label">Schedule</label>
                                    <input type="date" className="form-control" id="update_schedule" name="update_schedule" required></input>
                                </div>
                            </div>
                            <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button  type="button" className="btn btn-success" onClick={AdminUpdateAppointment.bind(this)}>Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
    //user modal
    const UserUpdateModal = ()=>{
        return(
            <div className="modal fade" id="UpdateAppointment" data-bs-backdrop="static" tabIndex="-1">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <form action="#" method="POST" onSubmit={FormSubmit.bind(this)} encType="multipart/form-data">
                            <div className="modal-header">
                            <h5 className="modal-title" id="assignment_title">Change Appointment Schedule</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div className='modal-body p-3'>
                                <input type={'hidden'} id='update_appointment_id' name='update_appointment_id'></input>
                                <div className="col mb-3">
                                    <label className="form-label">Schedule</label>
                                    <input type="date" className="form-control" id="update_schedule" name="update_schedule" required></input>
                                </div>

                            </div>
                            <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button  type="button" className="btn btn-success" onClick={UpdateAppointment.bind(this)}>Save Changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        );
    }

    //functions for crud operations
    const AdminUpdateAppointment=()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/admin/appointment/'+document.getElementById('update_appointment_id').value;

        let body={
            appointment_id:document.getElementById('update_appointment_id').value,
            schedule: document.getElementById('update_schedule').value,
            user_id:'N/A'
        }

        fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify(body)
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

    const UpdateAppointment=()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/appointment/'+document.getElementById('update_appointment_id').value;

        let body={
            appointment_id:document.getElementById('update_appointment_id').value,
            schedule: document.getElementById('update_schedule').value,
            user_id:'N/A'
        }

        fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify(body)
        })

        .then(res => res.json())
        .then(
            (result) => {
                console.log(result);
                window.location.reload();

            },
            (error) => {
                console.log(error);
            }
        );
    }

    return <DisplayModal/>;
}

export default UpdateAppointmentModal;
