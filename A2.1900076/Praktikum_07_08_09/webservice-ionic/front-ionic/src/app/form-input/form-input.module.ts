import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { FormInputPageRoutingModule } from './form-input-routing.module';

import { FormInputPage } from './form-input.page';


import { ReactiveFormsModule } from '@angular/forms';
import { from } from 'rxjs';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path:"",
    component: FormInputPage
  }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ReactiveFormsModule,
    RouterModule.forChild(routes)
  ],
  declarations: [FormInputPage]
})
export class FormInputPageModule {}
