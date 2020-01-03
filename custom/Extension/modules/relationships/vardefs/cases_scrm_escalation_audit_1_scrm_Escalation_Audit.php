<?php
// created: 2017-04-19 15:03:00
$dictionary["scrm_Escalation_Audit"]["fields"]["cases_scrm_escalation_audit_1"] = array (
  'name' => 'cases_scrm_escalation_audit_1',
  'type' => 'link',
  'relationship' => 'cases_scrm_escalation_audit_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_CASES_SCRM_ESCALATION_AUDIT_1_FROM_CASES_TITLE',
  'id_name' => 'cases_scrm_escalation_audit_1cases_ida',
);
$dictionary["scrm_Escalation_Audit"]["fields"]["cases_scrm_escalation_audit_1_name"] = array (
  'name' => 'cases_scrm_escalation_audit_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_SCRM_ESCALATION_AUDIT_1_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'cases_scrm_escalation_audit_1cases_ida',
  'link' => 'cases_scrm_escalation_audit_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["scrm_Escalation_Audit"]["fields"]["cases_scrm_escalation_audit_1cases_ida"] = array (
  'name' => 'cases_scrm_escalation_audit_1cases_ida',
  'type' => 'link',
  'relationship' => 'cases_scrm_escalation_audit_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CASES_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_AUDIT_TITLE',
);
