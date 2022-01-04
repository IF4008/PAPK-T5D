import { Component } from '@angular/core';
import { LoadingController } from '@ionic/angular';
import { AuthServiceService } from './../../app/auth-service.service';
import { AlertController } from '@ionic/angular';
import { NgZone } from '@angular/core';
import { loadingController } from '@ionic/core';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {
ResponData: any;
Data_Barang: any;
  constructor(
    public api: AuthServiceService,
    public loadingController: LoadingController,
    public alertController: AlertController,
    public zone: NgZone
  ) {}

//buat fungsi untuk request data barang, konfirmasi hapus, dan hapus data barang

ionVieWillEnter(){
  this.DataBarang
}

async DataBarang(){
  const loading= await this.loadingController.create({
    message: 'Loading...',
  });
await loading.present();
await this.api.Get_Data('Data_Barang').subscribe(
  (res)=>{
    this.ResponData= res;
    if (this.ResponData.Data_Barang){
      this.Data_Barang = this.ResponData.Data_Barang;
      loadingController.dismiss();
    }else{
      this.Data_Barang='';
      loadingController.dismiss();
    }
  },
  (err)=>{
    console.log(err);
    loadingController.dismiss();
    }
);
}

  async presentAlertConfirm(idbarang){
  const alert = await this.alertController.create({
    header: "Konfirmasi",
    message: 'Apakah adna yakin akan menghapus data ini?',
    buttons:[
      {
        text: 'Tidak',
        role: 'Cancel',
        cssClass: 'secondary',
        handler: (blah)=>{},
      },
      {
        text : 'Ya',
        handler: ()=>{
          this.HapusData(idbarang);
        },
      },
    ],
  });
  await alert.present();
}

HapusData(idbarang){
  const idbarangDelete={
    id_barang: idbarang,
  };
this.api.Post_Data('Delete_Barang', idbarangDelete).subscribe(
  (res)=>{
    this.zone.run(() => {
      this.DataBarang();
    });
  },
  (err)=>{
    console.log(err);
  }
);
}
}