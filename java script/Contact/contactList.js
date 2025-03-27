// the inputs
var nameC = document.querySelector('#contactName');
var phone = document.querySelector('#phone');
var emailInput = document.querySelector('#email');
var photo = document.querySelector('#photo');
var searchBar = document.querySelector('#search');


// the buttons
var  saveBtn = document.querySelector('#saveContact');
var  editBtn = document.querySelector('#editBtn');
var  deleteBtn = document.querySelector("#deleteBtn");
// contact container
var  contactsList = document.querySelector("#contactsList");
var  contactsContainer = document.querySelector('#contactsContainer');

// declaring the contacts list
let contacts = localStorage.getItem('contacts')? JSON.parse(localStorage.getItem('contacts')) : [];

// functions ------------------------------------------------

let displayContacts = () => {
    if (contacts.length == 0) {
        contactsList.classList.add('d-none');
        return;
    };



    contactsList.classList.remove('d-none');

    // contactsContainer.innerHTML = contacts.map((contact, i)=>`<div class="d-flex gap-3 flex-wrap" id="contactsContainer">
    //                                     <div class="card border border-2 w-auto">
    //                                         <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
    //                                             <div class="">
    //                                                 <img src="${contact.photo?contact.photo:''}" alt="" class="rounded-pill img-fluid">
    //                                             </div>
    //                                             <div class="card-title">${contact.name}</div>

    //                                             <div class="card-text">
    //                                                 <div class="fw-bold">${contact.phone} </div>
    //                                                 <div class="">${contact.email} </div>
    //                                             </div>
    //                                             <div class="">
    //                                                 <button class="btn btn-dark" id="editBtn"><i class="fa-solid fa-pencil"></i></button>
    //                                                 <button class="btn btn-danger" id="deleteBtn"><i class="fa-regular fa-trash-can"></i></button>
                                                
    //                                             </div>
    //                                         </div>
    //                                     </div>
    //         </div>`).join('');
    

    contactsContainer.innerHTML = '';
    for (let contact of contacts) {
        contactsContainer.innerHTML += `<div class="d-flex gap-3 flex-wrap" id="contactsContainer">
                                        <div class="card border border-2 w-auto">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                                <div class="">
                                                    <img src="${contact.photo?contact.photo:''}" alt="" class="rounded-pill img-fluid">
                                                </div>
                                                <div class="card-title">${contact.name}</div>

                                                <div class="card-text">
                                                    <div class="fw-bold">${contact.phone} </div>
                                                    <div class="">${contact.email} </div>
                                                </div>
                                                <div class="">
                                                    <button class="btn btn-dark" id="editBtn"><i class="fa-solid fa-pencil"></i></button>
                                                    <button class="btn btn-danger" id="deleteBtn"><i class="fa-regular fa-trash-can"></i></button>
                                                
                                                </div>
                                            </div>
                                        </div>
            </div>`


    };
};


let addContact = () => {
    let contactName = nameC.value.trim();
    let contactPhone = phone.value.trim();
    let contactEmail = email.value.trim();
    let contactPhoto = photo.value;
    if(contactName =="" || contactPhone == ""  || contactEmail == "") {
        alert('Please fill out the required fields.');
        return;
    }
    // creating the contact
    // use uuid for unique id
    let contact = {name: contactName, phone: contactPhone, email: contactEmail, photo:contactPhoto?contactPhoto:null};
    // adding it to the contacts list
    contacts.push(contact);
    // updating the local storage
    localStorage.setItem('contacts', JSON.stringify(contacts));
    displayContacts();
};






displayContacts();

