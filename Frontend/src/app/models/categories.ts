export interface Categories {
  parent: { name: string; };
  expandable: boolean;
  children?: [];
  name: string;
  level: number;
  // https://resources.fabric.inc/blog/ecommerce-data-model
  id: string;
  description: string;
  code: number;
  parentCode: number;
  created: Date;
}
