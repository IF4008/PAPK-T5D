import { Component, OnInit } from '@angular/core';
import { LoadingController, NavController } from '@ionic/angular';
import { AuthServiceService } from './../../app/auth-service.service';
import { AlertController } from '@ionic/angular';

import {
  FormControl,
  FormGroupDirective,
  FormBuilder,
  NgForm,
  Validators,
  FormGroup,
} from '@angular/forms';

@Component({
  selector: 'app-form-input',
  templateUrl: './form-input.page.html',
  styleUrls: ['./form-input.page.scss'],
})
export class FormInputPage implements OnInit {
  public FormSimpanData: FormGroup;

  constructor(
    public navCtrl: NavController,
    public api: AuthServiceService,
    public LoadingController: LoadingController,
    public AlertController: AlertController,
    private formBulder: FormBuilder, 
  ) {
    this.FormSimpanData = this.formBulder.group({
      tgl: ['', Validators.required],
      nama: ['', Validators.required],
      kelas: ['', Validators.required],
      keterangan: ['', Validators.required],
    });
   }

  ngOnInit() {}

  // fungsi untuk simpan data

  simpan() {
    this.api.Post_Data('Input_Absensi', this.FormSimpanData.value).subscribe(
      (res) =>{
        this.navCtrl.navigateBack('/home');
      },
      (err) => {
        console.log(err);
      }
    );
  }
}
