import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { FormEditPage } from './form-edit.page';

const routes: Routes = [
  {
    path: '',
    component: FormEditPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class FormEditPageRoutingModule {}
