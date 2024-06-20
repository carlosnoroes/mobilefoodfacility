#!/usr/env perl

use common::sense;

use DBI;
use FindBin      qw($Script);
use Path::Tiny;
use Text::CSV_XS qw(csv); 
use Getopt::Long;
use Try::Tiny;

my $config = {
    'schema'   => 'challenge',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => '',
};

my $CSV_FILE = 'Mobile_Food_Facility_Permit.csv';
my $dataset  = csv (in => $CSV_FILE, headers => "auto");

my $dbh = _connect();

foreach my $row ( @{$dataset})
{
    my $values;
    my $fields;
    foreach my $field ( keys %{$row} )
    {
        $fields .=  $field =~ / /  ? "`$field`, ": $field.',';

        $row->{$field} =~ s/(\d+)\/(\d+)\/(\d+)\s*(\d+\:\d+\:\d+).*/$3-$1-$2 $4/g if ( $field =~ /ExpirationDate|Approved/ );
        $row->{$field} =~ s/\'/\\'/g;

        $values .=  $row->{$field} ? " '$row->{$field}'," : " NULL,";
    }

    $values =~ s/,\s*$//g;
    $fields =~ s/,\s*$//g;
    my $sql_insert_permit = "INSERT INTO permit ( $fields ) VALUES ( $values )";

    my $sth = $dbh->prepare($sql_insert_permit);

    try {
        $sth->execute();   
    }
    catch{
        print $_;
    };
}

print "All records imported to the database!\n";
###########################################################
sub _connect {
 
    my $dbh = DBI->connect(
        'DBI:mysql:database=' . $config->{schema} . ';host=' . $config->{host},
        $config->{user} => $config->{password},
        { RaiseError => 1, PrintError => 0, InactiveDestroy => 1 }
    );
    $dbh->{'mysql_auto_reconnect'} = 1;

    return $dbh;
}