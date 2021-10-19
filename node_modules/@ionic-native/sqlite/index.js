var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
import { IonicNativePlugin, cordova, checkAvailability, cordovaInstance, instancePropertyGet, instancePropertySet } from '@ionic-native/core';
var SQLiteObject = /** @class */ (function () {
    function SQLiteObject(_objectInstance) {
        this._objectInstance = _objectInstance;
    }
    SQLiteObject.prototype.addTransaction = function (transaction) { return cordovaInstance(this, "addTransaction", { "sync": true }, arguments); };
    SQLiteObject.prototype.transaction = function (fn) { return cordovaInstance(this, "transaction", { "successIndex": 2, "errorIndex": 1 }, arguments); };
    SQLiteObject.prototype.readTransaction = function (fn) { return cordovaInstance(this, "readTransaction", {}, arguments); };
    SQLiteObject.prototype.startNextTransaction = function () { return cordovaInstance(this, "startNextTransaction", { "sync": true }, arguments); };
    SQLiteObject.prototype.open = function () { return cordovaInstance(this, "open", {}, arguments); };
    SQLiteObject.prototype.close = function () { return cordovaInstance(this, "close", {}, arguments); };
    SQLiteObject.prototype.executeSql = function (statement, params) { return cordovaInstance(this, "executeSql", {}, arguments); };
    SQLiteObject.prototype.sqlBatch = function (sqlStatements) { return cordovaInstance(this, "sqlBatch", {}, arguments); };
    SQLiteObject.prototype.abortallPendingTransactions = function () { return cordovaInstance(this, "abortallPendingTransactions", { "sync": true }, arguments); };
    Object.defineProperty(SQLiteObject.prototype, "databaseFeatures", {
        get: function () { return instancePropertyGet(this, "databaseFeatures"); },
        set: function (value) { instancePropertySet(this, "databaseFeatures", value); },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(SQLiteObject.prototype, "openDBs", {
        get: function () { return instancePropertyGet(this, "openDBs"); },
        set: function (value) { instancePropertySet(this, "openDBs", value); },
        enumerable: false,
        configurable: true
    });
    return SQLiteObject;
}());
export { SQLiteObject };
var SQLiteOriginal = /** @class */ (function (_super) {
    __extends(SQLiteOriginal, _super);
    function SQLiteOriginal() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    SQLiteOriginal.prototype.create = function (config) {
        var _this = this;
        return (function () {
            if (checkAvailability(_this) === true) {
                return new Promise(function (resolve, reject) {
                    sqlitePlugin.openDatabase(config, function (db) { return resolve(new SQLiteObject(db)); }, reject);
                });
            }
        })();
    };
    SQLiteOriginal.prototype.echoTest = function () { return cordova(this, "echoTest", {}, arguments); };
    SQLiteOriginal.prototype.selfTest = function () { return cordova(this, "selfTest", {}, arguments); };
    SQLiteOriginal.prototype.deleteDatabase = function (config) { return cordova(this, "deleteDatabase", {}, arguments); };
    SQLiteOriginal.pluginName = "SQLite";
    SQLiteOriginal.pluginRef = "sqlitePlugin";
    SQLiteOriginal.plugin = "cordova-sqlite-storage";
    SQLiteOriginal.repo = "https://github.com/litehelpers/Cordova-sqlite-storage";
    SQLiteOriginal.platforms = ["Android", "iOS", "macOS", "Windows"];
    return SQLiteOriginal;
}(IonicNativePlugin));
var SQLite = new SQLiteOriginal();
export { SQLite };
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiaW5kZXguanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlcyI6WyIuLi8uLi8uLi8uLi9zcmMvQGlvbmljLW5hdGl2ZS9wbHVnaW5zL3NxbGl0ZS9pbmRleC50cyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7O0FBQ0EsT0FBTyw0R0FPTixNQUFNLG9CQUFvQixDQUFDOztJQXdEMUIsc0JBQW1CLGVBQW9CO1FBQXBCLG9CQUFlLEdBQWYsZUFBZSxDQUFLO0lBQUcsQ0FBQztJQVEzQyxxQ0FBYyxhQUFDLFdBQTRDO0lBVTNELGtDQUFXLGFBQUMsRUFBK0I7SUFTM0Msc0NBQWUsYUFBQyxFQUFtQztJQU9uRCwyQ0FBb0I7SUFNcEIsMkJBQUk7SUFRSiw0QkFBSztJQVNMLGlDQUFVLGFBQUMsU0FBaUIsRUFBRSxNQUFjO0lBUzVDLCtCQUFRLGFBQUMsYUFBMEM7SUFPbkQsa0RBQTJCOzBCQXZFUCwwQ0FBZ0I7Ozs7OzswQkFDaEIsaUNBQU87Ozs7Ozt1QkFuRTdCOzs7O0lBMEw0QiwwQkFBaUI7Ozs7SUFVM0MsdUJBQU0sYUFBQyxNQUE0Qjs7O21EQUF5QjtnQkFDMUQsT0FBTyxJQUFJLE9BQU8sQ0FBQyxVQUFDLE9BQU8sRUFBRSxNQUFNO29CQUNqQyxZQUFZLENBQUMsWUFBWSxDQUFDLE1BQU0sRUFBRSxVQUFDLEVBQU8sSUFBSyxPQUFBLE9BQU8sQ0FBQyxJQUFJLFlBQVksQ0FBQyxFQUFFLENBQUMsQ0FBQyxFQUE3QixDQUE2QixFQUFFLE1BQU0sQ0FBQyxDQUFDO2dCQUN4RixDQUFDLENBQUMsQ0FBQzthQUNKOzs7SUFPRCx5QkFBUTtJQVNSLHlCQUFRO0lBVVIsK0JBQWMsYUFBQyxNQUE0Qjs7Ozs7O2lCQWxPN0M7RUEwTDRCLGlCQUFpQjtTQUFoQyxNQUFNIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgSW5qZWN0YWJsZSB9IGZyb20gJ0Bhbmd1bGFyL2NvcmUnO1xuaW1wb3J0IHtcbiAgQ29yZG92YSxcbiAgQ29yZG92YUNoZWNrLFxuICBDb3Jkb3ZhSW5zdGFuY2UsXG4gIEluc3RhbmNlUHJvcGVydHksXG4gIElvbmljTmF0aXZlUGx1Z2luLFxuICBQbHVnaW4sXG59IGZyb20gJ0Bpb25pYy1uYXRpdmUvY29yZSc7XG5cbmRlY2xhcmUgY29uc3Qgc3FsaXRlUGx1Z2luOiBhbnk7XG5cbmV4cG9ydCBpbnRlcmZhY2UgU1FMaXRlRGF0YWJhc2VDb25maWcge1xuICAvKipcbiAgICogTmFtZSBvZiB0aGUgZGF0YWJhc2UuIEV4YW1wbGU6ICdteS5kYidcbiAgICovXG4gIG5hbWU6IHN0cmluZztcbiAgLyoqXG4gICAqIExvY2F0aW9uIG9mIHRoZSBkYXRhYmFzZS4gRXhhbXBsZTogJ2RlZmF1bHQnXG4gICAqL1xuICBsb2NhdGlvbj86IHN0cmluZztcbiAgLyoqXG4gICAqIGlPUyBEYXRhYmFzZSBMb2NhdGlvbi4gRXhhbXBsZTogJ0xpYnJhcnknXG4gICAqL1xuICBpb3NEYXRhYmFzZUxvY2F0aW9uPzogc3RyaW5nO1xuICAvKipcbiAgICogc3VwcG9ydCBhcmJpdHJhcnkgZGF0YWJhc2UgbG9jYXRpb24gb24gYW5kcm9pZCB3aXRoIGh0dHBzOi8vZ2l0aHViLmNvbS9saXRlaGVscGVycy9jb3Jkb3ZhLXNxbGl0ZS1ldmNvcmUtZXh0YnVpbGQtZnJlZVxuICAgKi9cbiAgYW5kcm9pZERhdGFiYXNlTG9jYXRpb24/OiBzdHJpbmc7XG4gIC8qKlxuICAgKiBzdXBwb3J0IG9wZW5pbmcgcHJlLWZpbGxlZCBkYXRhYmFzZXMgd2l0aCBodHRwczovL2dpdGh1Yi5jb20vbGl0ZWhlbHBlcnMvY29yZG92YS1zcWxpdGUtZXh0XG4gICAqL1xuICBjcmVhdGVGcm9tTG9jYXRpb24/OiBudW1iZXI7XG4gIC8qKlxuICAgKiBzdXBwb3J0IGVuY3J5cHRlZCBkYXRhYmFzZXMgd2l0aCBodHRwczovL2dpdGh1Yi5jb20vbGl0ZWhlbHBlcnMvQ29yZG92YS1zcWxjaXBoZXItYWRhcHRlclxuICAgKi9cbiAga2V5Pzogc3RyaW5nO1xufVxuXG4vKipcbiAqIEBoaWRkZW5cbiAqL1xuZXhwb3J0IGludGVyZmFjZSBEYlRyYW5zYWN0aW9uIHtcbiAgZXhlY3V0ZVNxbDogKHNxbDogYW55LCB2YWx1ZXM/OiBhbnlbXSwgc3VjY2Vzcz86IEZ1bmN0aW9uLCBlcnJvcj86IEZ1bmN0aW9uKSA9PiB2b2lkO1xufVxuXG4vKipcbiAqIEBoaWRkZW5cbiAqL1xuZXhwb3J0IGludGVyZmFjZSBTUUxpdGVUcmFuc2FjdGlvbiBleHRlbmRzIERiVHJhbnNhY3Rpb24ge1xuICBzdGFydDogKCkgPT4gdm9pZDtcbiAgYWRkU3RhdGVtZW50OiBEYlRyYW5zYWN0aW9uWydleGVjdXRlU3FsJ107XG4gIGhhbmRsZVN0YXRlbWVudFN1Y2Nlc3M6IChoYW5kbGVyOiBGdW5jdGlvbiwgcmVzcG9uc2U6IGFueSkgPT4gdm9pZDtcbiAgaGFuZGxlU3RhdGVtZW50RmFpbHVyZTogKGhhbmRsZXI6IEZ1bmN0aW9uLCByZXNwb25zZTogYW55KSA9PiB2b2lkO1xuICBydW46ICgpID0+IHZvaWQ7XG4gIGFib3J0OiAodHhGYWlsdXJlOiBhbnkpID0+IHZvaWQ7XG4gIGZpbmlzaDogKCkgPT4gdm9pZDtcbiAgYWJvcnRGcm9tUTogKHNxbGVycm9yOiBhbnkpID0+IHZvaWQ7XG59XG5cbi8qKlxuICogQGhpZGRlblxuICovXG5leHBvcnQgY2xhc3MgU1FMaXRlT2JqZWN0IHtcbiAgY29uc3RydWN0b3IocHVibGljIF9vYmplY3RJbnN0YW5jZTogYW55KSB7fVxuXG4gIEBJbnN0YW5jZVByb3BlcnR5KCkgZGF0YWJhc2VGZWF0dXJlczogeyBpc1NRTGl0ZVBsdWdpbkRhdGFiYXNlOiBib29sZWFuIH07XG4gIEBJbnN0YW5jZVByb3BlcnR5KCkgb3BlbkRCczogYW55O1xuXG4gIEBDb3Jkb3ZhSW5zdGFuY2Uoe1xuICAgIHN5bmM6IHRydWUsXG4gIH0pXG4gIGFkZFRyYW5zYWN0aW9uKHRyYW5zYWN0aW9uOiAodHg6IFNRTGl0ZVRyYW5zYWN0aW9uKSA9PiB2b2lkKTogdm9pZCB7fVxuXG4gIC8qKlxuICAgKiBAcGFyYW0gZm4ge0Z1bmN0aW9ufVxuICAgKiBAcmV0dXJucyB7UHJvbWlzZTxhbnk+fVxuICAgKi9cbiAgQENvcmRvdmFJbnN0YW5jZSh7XG4gICAgc3VjY2Vzc0luZGV4OiAyLFxuICAgIGVycm9ySW5kZXg6IDEsXG4gIH0pXG4gIHRyYW5zYWN0aW9uKGZuOiAodHg6IERiVHJhbnNhY3Rpb24pID0+IHZvaWQpOiBQcm9taXNlPGFueT4ge1xuICAgIHJldHVybjtcbiAgfVxuXG4gIC8qKlxuICAgKiBAcGFyYW0gZm4ge0Z1bmN0aW9ufVxuICAgKiBAcmV0dXJucyB7UHJvbWlzZTxhbnk+fVxuICAgKi9cbiAgQENvcmRvdmFJbnN0YW5jZSgpXG4gIHJlYWRUcmFuc2FjdGlvbihmbjogKHR4OiBTUUxpdGVUcmFuc2FjdGlvbikgPT4gdm9pZCk6IFByb21pc2U8YW55PiB7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgQENvcmRvdmFJbnN0YW5jZSh7XG4gICAgc3luYzogdHJ1ZSxcbiAgfSlcbiAgc3RhcnROZXh0VHJhbnNhY3Rpb24oKTogdm9pZCB7fVxuXG4gIC8qKlxuICAgKiBAcmV0dXJucyB7UHJvbWlzZTxhbnk+fVxuICAgKi9cbiAgQENvcmRvdmFJbnN0YW5jZSgpXG4gIG9wZW4oKTogUHJvbWlzZTxhbnk+IHtcbiAgICByZXR1cm47XG4gIH1cblxuICAvKipcbiAgICogQHJldHVybnMge1Byb21pc2U8YW55Pn1cbiAgICovXG4gIEBDb3Jkb3ZhSW5zdGFuY2UoKVxuICBjbG9zZSgpOiBQcm9taXNlPGFueT4ge1xuICAgIHJldHVybjtcbiAgfVxuXG4gIC8qKlxuICAgKiBFeGVjdXRlIFNRTCBvbiB0aGUgb3BlbmVkIGRhdGFiYXNlLiBOb3RlLCB5b3UgbXVzdCBjYWxsIGBjcmVhdGVgIGZpcnN0LCBhbmRcbiAgICogZW5zdXJlIGl0IHJlc29sdmVkIGFuZCBzdWNjZXNzZnVsbHkgb3BlbmVkIHRoZSBkYXRhYmFzZS5cbiAgICovXG4gIEBDb3Jkb3ZhSW5zdGFuY2UoKVxuICBleGVjdXRlU3FsKHN0YXRlbWVudDogc3RyaW5nLCBwYXJhbXM/OiBhbnlbXSk6IFByb21pc2U8YW55PiB7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgLyoqXG4gICAqIEBwYXJhbSBzcWxTdGF0ZW1lbnRzIHtzdHJpbmdbXSB8IHN0cmluZ1tdW10gfCBhbnlbXX1cbiAgICogQHJldHVybnMge1Byb21pc2U8YW55Pn1cbiAgICovXG4gIEBDb3Jkb3ZhSW5zdGFuY2UoKVxuICBzcWxCYXRjaChzcWxTdGF0ZW1lbnRzOiAoc3RyaW5nIHwgc3RyaW5nW10gfCBhbnkpW10pOiBQcm9taXNlPGFueT4ge1xuICAgIHJldHVybjtcbiAgfVxuXG4gIEBDb3Jkb3ZhSW5zdGFuY2Uoe1xuICAgIHN5bmM6IHRydWUsXG4gIH0pXG4gIGFib3J0YWxsUGVuZGluZ1RyYW5zYWN0aW9ucygpOiB2b2lkIHt9XG59XG5cbi8qKlxuICogQG5hbWUgU1FMaXRlXG4gKlxuICogQGRlc2NyaXB0aW9uXG4gKiBBY2Nlc3MgU1FMaXRlIGRhdGFiYXNlcyBvbiB0aGUgZGV2aWNlLlxuICpcbiAqIEB1c2FnZVxuICpcbiAqIGBgYHR5cGVzY3JpcHRcbiAqIGltcG9ydCB7IFNRTGl0ZSwgU1FMaXRlT2JqZWN0IH0gZnJvbSAnQGlvbmljLW5hdGl2ZS9zcWxpdGUvbmd4JztcbiAqXG4gKiBjb25zdHJ1Y3Rvcihwcml2YXRlIHNxbGl0ZTogU1FMaXRlKSB7IH1cbiAqXG4gKiAuLi5cbiAqXG4gKiB0aGlzLnNxbGl0ZS5jcmVhdGUoe1xuICogICBuYW1lOiAnZGF0YS5kYicsXG4gKiAgIGxvY2F0aW9uOiAnZGVmYXVsdCdcbiAqIH0pXG4gKiAgIC50aGVuKChkYjogU1FMaXRlT2JqZWN0KSA9PiB7XG4gKlxuICpcbiAqICAgICBkYi5leGVjdXRlU3FsKCdjcmVhdGUgdGFibGUgZGFuY2VNb3ZlcyhuYW1lIFZBUkNIQVIoMzIpKScsIFtdKVxuICogICAgICAgLnRoZW4oKCkgPT4gY29uc29sZS5sb2coJ0V4ZWN1dGVkIFNRTCcpKVxuICogICAgICAgLmNhdGNoKGUgPT4gY29uc29sZS5sb2coZSkpO1xuICpcbiAqXG4gKiAgIH0pXG4gKiAgIC5jYXRjaChlID0+IGNvbnNvbGUubG9nKGUpKTtcbiAqXG4gKiBgYGBcbiAqXG4gKiBAY2xhc3Nlc1xuICogU1FMaXRlT2JqZWN0XG4gKiBAaW50ZXJmYWNlc1xuICogU1FMaXRlRGF0YWJhc2VDb25maWdcbiAqIFNRTGl0ZVRyYW5zYWN0aW9uXG4gKi9cbkBQbHVnaW4oe1xuICBwbHVnaW5OYW1lOiAnU1FMaXRlJyxcbiAgcGx1Z2luUmVmOiAnc3FsaXRlUGx1Z2luJyxcbiAgcGx1Z2luOiAnY29yZG92YS1zcWxpdGUtc3RvcmFnZScsXG4gIHJlcG86ICdodHRwczovL2dpdGh1Yi5jb20vbGl0ZWhlbHBlcnMvQ29yZG92YS1zcWxpdGUtc3RvcmFnZScsXG4gIHBsYXRmb3JtczogWydBbmRyb2lkJywgJ2lPUycsICdtYWNPUycsICdXaW5kb3dzJ10sXG59KVxuQEluamVjdGFibGUoKVxuZXhwb3J0IGNsYXNzIFNRTGl0ZSBleHRlbmRzIElvbmljTmF0aXZlUGx1Z2luIHtcbiAgLyoqXG4gICAqIE9wZW4gb3IgY3JlYXRlIGEgU1FMaXRlIGRhdGFiYXNlIGZpbGUuXG4gICAqXG4gICAqIFNlZSB0aGUgcGx1Z2luIGRvY3MgZm9yIGFuIGV4cGxhbmF0aW9uIG9mIGFsbCBvcHRpb25zOiBodHRwczovL2dpdGh1Yi5jb20vbGl0ZWhlbHBlcnMvQ29yZG92YS1zcWxpdGUtc3RvcmFnZSNvcGVuaW5nLWEtZGF0YWJhc2VcbiAgICpcbiAgICogQHBhcmFtIGNvbmZpZyB7U1FMaXRlRGF0YWJhc2VDb25maWd9IGRhdGFiYXNlIGNvbmZpZ3VyYXRpb25cbiAgICogQHJldHVybiBQcm9taXNlPFNRTGl0ZU9iamVjdD5cbiAgICovXG4gIEBDb3Jkb3ZhQ2hlY2soKVxuICBjcmVhdGUoY29uZmlnOiBTUUxpdGVEYXRhYmFzZUNvbmZpZyk6IFByb21pc2U8U1FMaXRlT2JqZWN0PiB7XG4gICAgcmV0dXJuIG5ldyBQcm9taXNlKChyZXNvbHZlLCByZWplY3QpID0+IHtcbiAgICAgIHNxbGl0ZVBsdWdpbi5vcGVuRGF0YWJhc2UoY29uZmlnLCAoZGI6IGFueSkgPT4gcmVzb2x2ZShuZXcgU1FMaXRlT2JqZWN0KGRiKSksIHJlamVjdCk7XG4gICAgfSk7XG4gIH1cblxuICAvKipcbiAgICogVmVyaWZ5IHRoYXQgYm90aCB0aGUgSmF2YXNjcmlwdCBhbmQgbmF0aXZlIHBhcnQgb2YgdGhpcyBwbHVnaW4gYXJlIGluc3RhbGxlZCBpbiB5b3VyIGFwcGxpY2F0aW9uXG4gICAqIEByZXR1cm5zIHtQcm9taXNlPGFueT59XG4gICAqL1xuICBAQ29yZG92YSgpXG4gIGVjaG9UZXN0KCk6IFByb21pc2U8YW55PiB7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgLyoqXG4gICAqIEF1dG9tYXRpY2FsbHkgdmVyaWZ5IGJhc2ljIGRhdGFiYXNlIGFjY2VzcyBvcGVyYXRpb25zIGluY2x1ZGluZyBvcGVuaW5nIGEgZGF0YWJhc2VcbiAgICogQHJldHVybnMge1Byb21pc2U8YW55Pn1cbiAgICovXG4gIEBDb3Jkb3ZhKClcbiAgc2VsZlRlc3QoKTogUHJvbWlzZTxhbnk+IHtcbiAgICByZXR1cm47XG4gIH1cblxuICAvKipcbiAgICogRGVsZXRlcyBhIGRhdGFiYXNlXG4gICAqIEBwYXJhbSBjb25maWcge1NRTGl0ZURhdGFiYXNlQ29uZmlnfSBkYXRhYmFzZSBjb25maWd1cmF0aW9uXG4gICAqIEByZXR1cm5zIHtQcm9taXNlPGFueT59XG4gICAqL1xuICBAQ29yZG92YSgpXG4gIGRlbGV0ZURhdGFiYXNlKGNvbmZpZzogU1FMaXRlRGF0YWJhc2VDb25maWcpOiBQcm9taXNlPGFueT4ge1xuICAgIHJldHVybjtcbiAgfVxufVxuIl19