export declare type KnobName = 'A' | 'B' | undefined;
export declare type RangeValue = number | {
  lower: number;
  upper: number;
};
export declare type PinFormatter = (value: number) => number | string;
export interface RangeChangeEventDetail {
  value: RangeValue;
}
export interface RangeCustomEvent extends CustomEvent {
  detail: RangeChangeEventDetail;
  target: HTMLIonRangeElement;
}
