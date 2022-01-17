import { Component, OnInit } from '@angular/core';

import { LoadingController,NavController } from '@ionic/angular';
import { AuthServiceService } from './../../app/auth-service.service';
import { AlertController } from '@ionic/angular';
import { FormControl, FormGroupDirective, FormBuilder, FormGroup, NgForm, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-form-edit',
  templateUrl: './form-edit.page.html',
  styleUrls: ['./form-edit.page.scss'],
})
export class FormEditPage implements OnInit {

  public FormEditData:FormGroup;
  ResponseData:any;
  dataAbsensiEdit:any;

  constructor(public navCtrl: NavController, 
    public api: AuthServiceService, 
    public loadingController: LoadingController,
    public alertController: AlertController, 
    private formBuilder: FormBuilder,
    private activatedRoute: ActivatedRoute) {
      this.FormEditData=this.formBuilder.group({
          id_mhs:[this.activatedRoute.snapshot.paramMap.get('id')],
          tgl:[null, Validators.required],
          nama:[null, Validators.required],
          kelas:[null, Validators.required],
          keterangan:[null, Validators.required]
        });
    }

    ngOnInit() {
      this.DataAbsensiEdit();
    }
  
     DataAbsensiEdit() {   
      const idmhsEdit={
        id_mhs:this.activatedRoute.snapshot.paramMap.get('id')
      };
      this.api.Post_Data('Get_Absensi_Edit',idmhsEdit)
        .subscribe(res => {
          this.ResponseData=res;
          if(this.ResponseData.Get_Absensi_Edit){
            this.dataAbsensiEdit=this.ResponseData.Get_Absensi_Edit;
            this.FormEditData.controls.tgl.setValue(this.dataAbsensiEdit[0].tgl);
            this.FormEditData.controls.nama.setValue(this.dataAbsensiEdit[0].nama);
            this.FormEditData.controls.kelas.setValue(this.dataAbsensiEdit[0].kelas);
            this.FormEditData.controls.keterangan.setValue(this.dataAbsensiEdit[0].keterangan);
          }
          else{ 
            this.dataAbsensiEdit='';
         }         
        }, err => {
          console.log(err);
        });
    }
  
    simpan(){
      this.api.Post_Data('Edit_Absensi',this.FormEditData.value)
        .subscribe(res => {
            this.navCtrl.navigateBack('/home');
          }, (err) => {
            console.log(err);
          });
    }

}