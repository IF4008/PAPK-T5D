import { IonicNativePlugin } from '@ionic-native/core';
export interface SQLiteDatabaseConfig {
    /**
     * Name of the database. Example: 'my.db'
     */
    name: string;
    /**
     * Location of the database. Example: 'default'
     */
    location?: string;
    /**
     * iOS Database Location. Example: 'Library'
     */
    iosDatabaseLocation?: string;
    /**
     * support arbitrary database location on android with https://github.com/litehelpers/cordova-sqlite-evcore-extbuild-free
     */
    androidDatabaseLocation?: string;
    /**
     * support opening pre-filled databases with https://github.com/litehelpers/cordova-sqlite-ext
     */
    createFromLocation?: number;
    /**
     * support encrypted databases with https://github.com/litehelpers/Cordova-sqlcipher-adapter
     */
    key?: string;
}
/**
 * @hidden
 */
export interface DbTransaction {
    executeSql: (sql: any, values?: any[], success?: Function, error?: Function) => void;
}
/**
 * @hidden
 */
export interface SQLiteTransaction extends DbTransaction {
    start: () => void;
    addStatement: DbTransaction['executeSql'];
    handleStatementSuccess: (handler: Function, response: any) => void;
    handleStatementFailure: (handler: Function, response: any) => void;
    run: () => void;
    abort: (txFailure: any) => void;
    finish: () => void;
    abortFromQ: (sqlerror: any) => void;
}
/**
 * @hidden
 */
export declare class SQLiteObject {
    _objectInstance: any;
    constructor(_objectInstance: any);
    databaseFeatures: {
        isSQLitePluginDatabase: boolean;
    };
    openDBs: any;
    addTransaction(transaction: (tx: SQLiteTransaction) => void): void;
    /**
     * @param fn {Function}
     * @returns {Promise<any>}
     */
    transaction(fn: (tx: DbTransaction) => void): Promise<any>;
    /**
     * @param fn {Function}
     * @returns {Promise<any>}
     */
    readTransaction(fn: (tx: SQLiteTransaction) => void): Promise<any>;
    startNextTransaction(): void;
    /**
     * @returns {Promise<any>}
     */
    open(): Promise<any>;
    /**
     * @returns {Promise<any>}
     */
    close(): Promise<any>;
    /**
     * Execute SQL on the opened database. Note, you must call `create` first, and
     * ensure it resolved and successfully opened the database.
     */
    executeSql(statement: string, params?: any[]): Promise<any>;
    /**
     * @param sqlStatements {string[] | string[][] | any[]}
     * @returns {Promise<any>}
     */
    sqlBatch(sqlStatements: (string | string[] | any)[]): Promise<any>;
    abortallPendingTransactions(): void;
}
/**
 * @name SQLite
 *
 * @description
 * Access SQLite databases on the device.
 *
 * @usage
 *
 * ```typescript
 * import { SQLite, SQLiteObject } from '@ionic-native/sqlite/ngx';
 *
 * constructor(private sqlite: SQLite) { }
 *
 * ...
 *
 * this.sqlite.create({
 *   name: 'data.db',
 *   location: 'default'
 * })
 *   .then((db: SQLiteObject) => {
 *
 *
 *     db.executeSql('create table danceMoves(name VARCHAR(32))', [])
 *       .then(() => console.log('Executed SQL'))
 *       .catch(e => console.log(e));
 *
 *
 *   })
 *   .catch(e => console.log(e));
 *
 * ```
 *
 * @classes
 * SQLiteObject
 * @interfaces
 * SQLiteDatabaseConfig
 * SQLiteTransaction
 */
export declare class SQLite extends IonicNativePlugin {
    /**
     * Open or create a SQLite database file.
     *
     * See the plugin docs for an explanation of all options: https://github.com/litehelpers/Cordova-sqlite-storage#opening-a-database
     *
     * @param config {SQLiteDatabaseConfig} database configuration
     * @return Promise<SQLiteObject>
     */
    create(config: SQLiteDatabaseConfig): Promise<SQLiteObject>;
    /**
     * Verify that both the Javascript and native part of this plugin are installed in your application
     * @returns {Promise<any>}
     */
    echoTest(): Promise<any>;
    /**
     * Automatically verify basic database access operations including opening a database
     * @returns {Promise<any>}
     */
    selfTest(): Promise<any>;
    /**
     * Deletes a database
     * @param config {SQLiteDatabaseConfig} database configuration
     * @returns {Promise<any>}
     */
    deleteDatabase(config: SQLiteDatabaseConfig): Promise<any>;
}
