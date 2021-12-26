/**
 * Determines if given year is a
 * leap year. Returns `true` if year
 * is a leap year. Returns `false`
 * otherwise.
 */
export declare const isLeapYear: (year: number) => boolean;
export declare const is24Hour: (locale: string, hourCycle?: "h23" | "h12" | undefined) => boolean;
/**
 * Given a date object, returns the number
 * of days in that month.
 * Month value begin at 1, not 0.
 * i.e. January = month 1.
 */
export declare const getNumDaysInMonth: (month: number, year: number) => 29 | 30 | 28 | 31;
