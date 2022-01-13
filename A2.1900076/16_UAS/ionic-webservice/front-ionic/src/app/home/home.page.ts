import { Component } from '@angular/core';
import { LoadingController } from '@ionic/angular';
import { AuthServiceService } from './../../app/auth-service.service';
import { AlertController } from '@ionic/angular';
import { NgZone } from '@angular/core';
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {
  ResponseData: any;
  Data_Absensi: any;
  constructor(
    public api: AuthServiceService,
    public loadingController: LoadingController,
    public alertController: AlertController,
    private zone: NgZone
  ) {}

  // Buat fungsi untuk request data Absensi, konfirmasi hapus, dan hapus data Absensi

  ionViewWillEnter() {
    this.DataAbsensi();
  }

  async DataAbsensi() {
    const loading = await this.loadingController.create({
      message: 'Loading...',
    });
    await loading.present();
    await this.api.Get_Data('Data_Absensi').subscribe(
      (res) => {
        this.ResponseData = res;
        if (this.ResponseData.Data_Absensi) {
          this.Data_Absensi = this.ResponseData.Data_Absensi;
          loading.dismiss();
        } else {
          this.Data_Absensi = '';
          loading.dismiss();
        }
      },
      (err) => {
        console.log(err);
        loading.dismiss();
      }
    );
  }
  
  async presentAlertConfirm(idmhs) {
    const alert = await this.alertController.create({
      header: "Konfirmasi",
      message: 'Apakah anda yakin akan menghapus data ini?',
      buttons: [
        {
          text: 'Tidak',
          role: 'Cancel',
          cssClass: 'secondary',
          handler: (blah) => { },
        },
        {
          text: 'Ya',
          handler:() => {
            this.HapusData(idmhs)
          },
        },
      ],
    });
    await alert.present();
  }

  HapusData(idmhs) {
    const idmhsDelete = {
      id_mhs: idmhs,
    };
    this.api.Post_Data('Delete_Absensi', idmhsDelete).subscribe(
      (res) => {
          this.zone.run(() => {
            this.DataAbsensi();
            });
        },
        (err) => {
          console.log(err);
        }
      );  
    }
  
}