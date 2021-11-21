import { Injectable } from '@angular/core';
import { Platform } from '@ionic/angular';
import { SQLite, SQLiteObject } from '@ionic-native/sqlite/ngx';

@Injectable({
  providedIn: 'root'
})

export class CrudService {
  // Cofig database
  private dbInstance: SQLiteObject;
  readonly db_name: string = "remotestack.db";
  readonly db_table: string = "userTable";
  USERS: Array <any> ;

  constructor(
    private platform: Platform,
    private sqlite: SQLite
  ) {
    this.databaseConn();
  }

    // Create SQLite database
    databaseConn() {
        this.platform.ready().then(() => {
          this.sqlite.create({
              name: this.db_name,
              location: 'default'
            }).then((sqLite: SQLiteObject) => {
              this.dbInstance = sqLite;
              sqLite.executeSql(`
                  CREATE TABLE IF NOT EXISTS ${this.db_table} (
                    user_id INTEGER PRIMARY KEY,
                    name varchar(255),
                    email varchar(255)
                  )`, [])
                .then((res) => {
                  // alert(JSON.stringify(res));
                })
                .catch((error) => alert(JSON.stringify(error)));
            })
            .catch((error) => alert(JSON.stringify(error)));
        });
    }

    // Proses Crud
    public addItem(n, e) {
      // validation
      if (!n.length || !e.length) {
        alert('Masukan Nama & Email Anda');
        return;
      }
      this.dbInstance.executeSql(`
      INSERT INTO ${this.db_table} (name, email) VALUES ('${n}', '${e}')`, [])
        .then(() => {
          alert("Success");
          this.getAllUsers();
        }, (e) => {
          alert(JSON.stringify(e.err));
        });
    }

    getAllUsers() {
      return this.dbInstance.executeSql(`SELECT * FROM ${this.db_table}`, []).then((res) => {
        this.USERS = [];
        if (res.rows.length > 0) {
          for (var i = 0; i < res.rows.length; i++) {
            this.USERS.push(res.rows.item(i));
          }
          return this.USERS;
        }
      },(e) => {
        alert(JSON.stringify(e));
      });
    }

    // Get user
    getUser(id): Promise<any> {
      return this.dbInstance.executeSql(`SELECT * FROM ${this.db_table} WHERE user_id = ?`, [id])
      .then((res) => {
        return {
          user_id: res.rows.item(0).user_id,
          name: res.rows.item(0).name,
          email: res.rows.item(0).email
        }
      });
    }

    // Update
    updateUser(id, name, email) {
      let data = [name, email];
      return this.dbInstance.executeSql(`UPDATE ${this.db_table} SET name = ?, email = ? WHERE user_id = ${id}`, data)
    }

    // Delete
    deleteUser(user) {
      this.dbInstance.executeSql(`
      DELETE FROM ${this.db_table} WHERE user_id = ${user}`, [])
        .then(() => {
          alert("User deleted!");
          this.getAllUsers();
        })
        .catch(e => {
          alert(JSON.stringify(e))
        });
    }

}
