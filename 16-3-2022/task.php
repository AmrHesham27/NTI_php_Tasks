<?php
/* Task .... 
Hospital management system that have 3 main types of users 1-admins 2-doctors 3-Patients.
With the following data.
Admins   (name, email, password ) ,    
Patients (name, email, password)  ,
Doctors  (name, email, password   , specialize(text) , gender).....  */

/* Doctors have appointments(day , from , to) and
Patients can reserve these appointments.
Note : doctor can accept or refuse reservations.
Requirments : create a database structure. */

# Solution
/*

// Analysis
Doctors  Patients
1           m
m           1
=================
m           m      ==> create new table (Appointments)

Doctors  Specialize
1            1
m            1     ==> foreign key is in Doctors

// TO DO 
==> create new table (Appointments)
==> foreign key is in Doctors

// Tables
Doctors
==================
id, name, email, password, (specialize = foreign_key), gender

Patients
====================
id, name, email, password

UnReviewed Appointments   this should br one table 
id, time,  doctor_id,  patient_id

Appointments
=============================
id time,  doctor_id,  patient_id

Specializes               ((DO I NEED THIS TABLE?))
=======================
id,  name 

Admins
====================
name, email, password

*/
?>

enter doctor appointments first 
table appointments (patients to appointments)