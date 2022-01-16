import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { FormInputPage } from './form-input.page';

const routes: Routes = [
  {
    path: '',
    component: FormInputPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class FormInputPageRoutingModule {}
